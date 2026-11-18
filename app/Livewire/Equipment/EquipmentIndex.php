<?php

namespace App\Livewire\Equipment;

use App\Models\Equipment;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'equipment'])]
class EquipmentIndex extends Component
{
    private const MAX_TOTAL = 100000;

    public array $equipment = [];
    public array $classes = [];
    public ?int $classId = null;
    public string $className = '';

    public function mount(): void
    {
        $student = Auth::guard('student')->user();

        if ($student) {
            $this->classId = (int) $student->class_id;
            $this->className = SchoolClass::find($student->class_id)?->name
                ?? 'Kelas tidak ditemukan';
        } else {
            $teacher = Auth::guard('teacher')->user();
            abort_unless($teacher, 403);

            $this->classes = SchoolClass::query()
                ->orderBy('name')
                ->get()
                ->toArray();

            if ($this->classes) {
                $this->classId = (int) $this->classes[0]['id'];
                $this->className = $this->classes[0]['name'];
            }
        }

        $this->loadEquipment();
    }

    public function updatedClassId(): void
    {
        $classId = $this->authorizedClassId();
        $this->className = $classId
            ? (SchoolClass::find($classId)?->name ?? '')
            : '';

        $this->loadEquipment();
    }

    public function loadEquipment(): void
    {
        $classId = $this->authorizedClassId();

        if (! $classId) {
            $this->equipment = [];
            return;
        }

        $this->equipment = Equipment::query()
            ->where('class_id', $classId)
            ->orderBy('name')
            ->get()
            ->toArray();
    }

    public function increment(int $id): void
    {
        $equipment = $this->findAccessibleEquipment($id);

        if ($equipment->total >= self::MAX_TOTAL) {
            session()->flash('error', 'Jumlah maksimal adalah 100000.');
            return;
        }

        $equipment->increment('total');
        $this->loadEquipment();

        session()->flash('success', 'Jumlah berhasil ditambah!');
    }

    public function decrement(int $id): void
    {
        $equipment = $this->findAccessibleEquipment($id);

        if ($equipment->total > 1) {
            $equipment->decrement('total');
            session()->flash('success', 'Jumlah berhasil dikurangi!');
        } else {
            session()->flash('error', 'Jumlah tidak bisa kurang dari 1!');
        }

        $this->loadEquipment();
    }

    public function delete(int $id): void
    {
        $this->findAccessibleEquipment($id)->delete();
        $this->loadEquipment();

        session()->flash('success', 'Perlengkapan berhasil dihapus!');
    }

    private function authorizedClassId(): ?int
    {
        $student = Auth::guard('student')->user();

        if ($student) {
            $this->classId = (int) $student->class_id;

            return (int) $student->class_id;
        }

        $teacher = Auth::guard('teacher')->user();
        abort_unless($teacher, 403);

        if (! $this->classId) {
            return null;
        }

        abort_unless(SchoolClass::whereKey($this->classId)->exists(), 403);

        return (int) $this->classId;
    }

    private function findAccessibleEquipment(int $id): Equipment
    {
        $classId = $this->authorizedClassId();
        abort_unless($classId, 403);

        return Equipment::query()
            ->where('class_id', $classId)
            ->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.equipment.index', [
            'classes' => $this->classes,
            'className' => $this->className,
        ]);
    }
}