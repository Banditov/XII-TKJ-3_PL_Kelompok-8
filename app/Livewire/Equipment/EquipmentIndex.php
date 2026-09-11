<?php

namespace App\Livewire\Equipment;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'equipment'])]
class EquipmentIndex extends Component
{
    public array $equipment = [
        ['id' => 1, 'name' => 'Proyektor', 'total' => 1, 'damaged' => 0],
        ['id' => 2, 'name' => 'Sapu', 'total' => 2, 'damaged' => 1],
    ];

    public function delete($id): void
    {
        $this->equipment = array_values(
            array_filter($this->equipment, fn($item) => $item['id'] !== $id)
        );

        session()->flash('success', 'Equipment berhasil dihapus!');
    }

    public function render()
    {
        return view('livewire.equipment.index');
    }
}