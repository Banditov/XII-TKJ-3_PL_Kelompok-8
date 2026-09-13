<?php

namespace App\Livewire\Sim;

use Livewire\Component;

class SimIndex extends Component
{
    public array $stats = [
        ['label' => 'Banyak Siswa', 'value' => 34, 'color' => 'blue', 'icon' => 'group'],
        ['label' => 'Memiliki SIM', 'value' => 8, 'color' => 'green', 'icon' => 'check'],
        ['label' => 'Tidak Punya SIM', 'value' => 26, 'color' => 'red', 'icon' => 'x'],
    ];

    public array $students = [
        ['name' => 'ABSEN - NAMA - NIS', 'status' => 'Memiliki SIM', 'hasSim' => true],
        ['name' => 'ABSEN - NAMA - NIS', 'status' => 'Tidak Memiliki SIM', 'hasSim' => false],
        ['name' => 'ABSEN - NAMA - NIS', 'status' => 'Memiliki SIM', 'hasSim' => true],
    ];

    public function render()
    {
        return view('livewire.sim.index')->layout('layouts.app');
    }
}
