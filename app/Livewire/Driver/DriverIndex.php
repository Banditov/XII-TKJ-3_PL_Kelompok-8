<?php
namespace App\Livewire\Driver;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'driver'])]
class DriverIndex extends Component
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
        return view('livewire.driver.index');
    }
}
