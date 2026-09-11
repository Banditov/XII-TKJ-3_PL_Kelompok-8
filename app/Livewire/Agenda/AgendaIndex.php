<?php
namespace App\Livewire\Agenda;

use App\Data\AgendaData;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'agenda'])]
class AgendaIndex extends Component
{
    public array $tasksNow = [];
    public array $tasksToday = [];
    public array $lateTasks = [];
    public array $upcomingTasks = [];

    public function mount(): void
    {
        $this->loadAgenda();
    }

    public function loadAgenda(): void
    {
        $this->tasksToday = AgendaData::today();
        $this->upcomingTasks = AgendaData::upcoming();
        $this->lateTasks = AgendaData::late();

        $this->tasksNow = array_merge($this->tasksToday, $this->upcomingTasks);
    }

    public function delete(int $id): void
    {
        session()->flash('success', 'Agenda berhasil dihapus!');
    }

    public function render()
    {
        return view('livewire.agenda.index');
    }
}