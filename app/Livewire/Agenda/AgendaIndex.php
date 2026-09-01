<?php

namespace App\Livewire\Agenda;

use Livewire\Component;

class AgendaIndex extends Component
{
    public array $tasksNow = [];

    public array $lateTasks = [];

    public function mount(): void
    {
        $this->tasksNow = [];

        $this->lateTasks = [
            [
                'title' => 'NAMA',
                'date' => 'Tanggal',
                'description' => 'Deskripsi',
            ],
        ];
    }

    public function render()
    {
        return view('livewire.agenda.index')->layout('layouts.app');
    }
}
