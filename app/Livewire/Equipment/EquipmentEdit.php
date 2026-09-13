<?php

namespace App\Livewire\Equipment;

use App\Data\EquipmentData;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'equipment.edit'])]
class EquipmentEdit extends Component
{
    public ?int $equipmentId = null;
    public string $name = '';
    public int $total = 1;
    public string $description = '';

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'total' => 'required|integer|min:1',
        'description' => 'nullable|max:1000',
    ];

    protected $messages = [
        'name.required' => 'Nama peralatan wajib diisi.',
        'name.min' => 'Nama minimal 3 karakter.',
        'total.required' => 'Total wajib diisi.',
        'total.min' => 'Total minimal 1.',
    ];

    public function mount(int $id): void
    {
        $this->equipmentId = $id;

        $equipment = EquipmentData::find($id);

        if (!$equipment) {
            abort(404, 'Peralatan tidak ditemukan.');
        }

        $this->name = $equipment['name'];
        $this->total = $equipment['total'];
        $this->description = $equipment['description'] ?? '';
    }

    public function save(): void
    {
        $this->validate();

        try {
            session()->flash('success', 'Peralatan berhasil diperbarui!');
            $this->redirect(route('equipment.index'));

        } catch (\Exception $e) {
            session()->flash('error', 'Gagal memperbarui peralatan. Silakan coba lagi.');
        }
    }

    public function delete(): void
    {
        try {
            session()->flash('success', 'Peralatan berhasil dihapus!');
            $this->redirect(route('equipment.index'));

        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus peralatan. Silakan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.equipment.edit');
    }
}