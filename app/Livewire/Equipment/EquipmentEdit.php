<?php
namespace App\Livewire\Equipment;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'equipment.edit'])]
class EquipmentEdit extends Component
{
    public ?int $equipmentId = null;
    public string $name = '';
    public int $total = 1;
    public int $damaged = 0;
    public string $description = '';

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'total' => 'required|integer|min:1',
        'damaged' => 'required|integer|min:0|lte:total',
        'description' => 'nullable|max:1000',
    ];

    protected $messages = [
        'name.required' => 'Nama peralatan wajib diisi.',
        'name.min' => 'Nama minimal 3 karakter.',
        'total.required' => 'Total wajib diisi.',
        'total.min' => 'Total minimal 1.',
        'damaged.required' => 'Jumlah rusak wajib diisi.',
        'damaged.lte' => 'Jumlah rusak tidak boleh melebihi total.',
    ];

    public function mount()
    {
    }

    public function save()
    {
    }

    public function render()
    {
        return view('livewire.equipment.edit');
    }
}