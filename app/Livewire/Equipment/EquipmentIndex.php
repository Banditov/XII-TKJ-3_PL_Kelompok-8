<?php

namespace App\Livewire\Equipment;

use App\Models\Equipment;
use App\Models\SchoolClass;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'equipment'])]
class EquipmentIndex extends Component
{
    #[Url(as: 'kelas')]
    public ?int $classId = null;

    public function mount(): void
    {
        $this->classId = $this->currentClass()?->id;
    }

    protected function accessibleClasses(): Collection
    {
        if ($student = Auth::guard('student')->user()) {
            return SchoolClass::where('id', $student->class_id)->get();
        }

        if ($teacher = Auth::guard('teacher')->user()) {
            return $teacher->schoolClasses()->orderBy('name')->get();
        }

        return collect();
    }

    protected function currentClass(): ?SchoolClass
    {
        $classes = $this->accessibleClasses();

        return $classes->firstWhere('id', $this->classId) ?? $classes->first();
    }

    protected function findEquipment(int $id): Equipment
    {
        $class = $this->currentClass();
        abort_if(! $class, 403, 'Anda belum terhubung ke kelas mana pun.');

        $item = Equipment::where('class_id', $class->id)->find($id);
        abort_if(! $item, 404);

        return $item;
    }

    public function increment(int $id): void
    {
        $this->findEquipment($id)->increment('total');

        session()->flash('success', 'Jumlah berhasil ditambah!');
    }

    public function decrement(int $id): void
    {
        $item = $this->findEquipment($id);

        if ($item->total <= 1) {
            session()->flash('error', 'Jumlah minimal 1. Gunakan tombol hapus untuk menghapus perlengkapan.');
            return;
        }

        $item->decrement('total');

        session()->flash('success', 'Jumlah berhasil dikurangi!');
    }

    public function delete(int $id): void
    {
        $this->findEquipment($id)->delete();

        session()->flash('success', 'Perlengkapan berhasil dihapus!');
    }

    public function render()
    {
        $class = $this->currentClass();
        $equipment = $class
            ? Equipment::where('class_id', $class->id)->orderBy('name')->get()->toArray()
            : [];

        return view('livewire.equipment.index', [
            'equipment' => $equipment,
            'classes' => $this->accessibleClasses(),
            'className' => $class?->name ?? 'Belum terhubung ke kelas',
        ]);
    }
}