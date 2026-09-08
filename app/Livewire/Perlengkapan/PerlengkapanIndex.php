<?php

namespace App\Livewire\Perlengkapan;

use Livewire\Component;

class PerlengkapanIndex extends Component
{
    public array $equipment = [
        ['name' => 'Proyektor', 'total' => 1, 'damaged' => 0],
        ['name' => 'Sapu', 'total' => 2, 'damaged' => 1],
    ];

    public function render()
    {
        return view('livewire.perlengkapan.index')->layout('layouts.app');
    }
}
