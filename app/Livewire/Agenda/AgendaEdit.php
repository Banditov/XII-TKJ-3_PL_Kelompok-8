<?php

namespace App\Livewire\Agenda;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Agenda;

#[Layout('layouts.app', ['active' => 'agenda.edit'])]
class AgendaEdit extends Component
{
    public function update()
    {
    }

    public function delete()
    {
    }

    public function render()
    {
        return view('livewire.agenda.edit');
    }
}