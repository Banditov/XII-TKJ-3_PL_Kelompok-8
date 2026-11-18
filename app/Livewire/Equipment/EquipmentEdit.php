<?php

namespace App\Livewire\Equipment;

use App\Models\Equipment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'equipment.edit'])]
class EquipmentEdit extends Component
{
    private const MAX_TOTAL = 100000;

    public ?int $equipmentId = null;
    public string $name = '';
    public int $total = 1;
    public string $description = '';

    protected $messages = [
        'name.required' => 'Nama peralatan wajib diisi.',
        'name.min' => 'Nama minimal 3 karakter.',
        'name.max' => 'Nama maksimal 255 karakter.',
        'name.unique' => 'Perlengkapan dengan nama ini sudah ada di kelas tersebut.',
        'total.required' => 'Total wajib diisi.',
        'total.integer' => 'Total harus berupa angka bulat.',
        'total.min' => 'Total minimal 1.',
        'total.max' => 'Total maksimal 100000.',
        'description.max' => 'Catatan maksimal 1000 karakter.',
    ];

    public function mount(int $id): void
    {
        $this->equipmentId = $id;
        $equipment = $this->findAccessibleEquipment();

        $this->name = $equipment->name;
        $this->total = $equipment->total;
        $this->description = $equipment->description ?? '';
    }

    public function increment(): void
    {
        $this->total = min(self::MAX_TOTAL, $this->total + 1);
    }

    public function decrement(): void
    {
        $this->total = max(1, $this->total - 1);
    }

    public function save(): void
    {
        $equipment = $this->findAccessibleEquipment();

        $validated = $this->validate([
            'name' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('equipment', 'name')
                    ->ignore($equipment->id)
                    ->where('class_id', $equipment->class_id),
            ],
            'total' => 'required|integer|min:1|max:100000',
            'description' => 'nullable|max:1000',
        ]);

        $equipment->update([
            'name' => trim($validated['name']),
            'total' => $validated['total'],
            'description' => trim($validated['description'] ?? '') ?: null,
        ]);

        session()->flash('success', 'Peralatan berhasil diperbarui!');
        $this->redirect(route('equipment.index'), navigate: true);
    }

    public function delete(): void
    {
        $this->findAccessibleEquipment()->delete();

        session()->flash('success', 'Peralatan berhasil dihapus!');
        $this->redirect(route('equipment.index'), navigate: true);
    }

    private function findAccessibleEquipment(): Equipment
    {
        $query = Equipment::query();

        if ($student = Auth::guard('student')->user()) {
            $query->where('class_id', $student->class_id);
        } elseif (! Auth::guard('teacher')->check()) {
            abort(403);
        }

        return $query->findOrFail($this->equipmentId);
    }

    public function render()
    {
        return view('livewire.equipment.edit');
    }
}