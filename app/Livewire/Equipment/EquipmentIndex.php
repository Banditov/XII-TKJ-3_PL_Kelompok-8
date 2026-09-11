<?php

namespace App\Livewire\Equipment;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'equipment'])]
class EquipmentIndex extends Component
{
    public array $equipment = [
        ['name' => 'Proyektor', 'total' => 1, 'damaged' => 0],
        ['name' => 'Sapu', 'total' => 2, 'damaged' => 1],
    ];

    public function render()
    {
        return view('livewire.equipment.index');
    }
}