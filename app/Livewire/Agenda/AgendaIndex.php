<?php

namespace App\Livewire\Agenda;

use App\Models\Agenda;
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
        $today = now()->toDateString();
        $toArray = static fn ($query): array => $query
            ->orderBy('date')
            ->orderBy('time')
            ->get()
            ->toArray();

        $this->tasksToday = $toArray(Agenda::query()->whereDate('date', $today));
        $this->upcomingTasks = $toArray(Agenda::query()->whereDate('date', '>', $today));
        $this->lateTasks = $toArray(Agenda::query()->whereDate('date', '<', $today));
        $this->tasksNow = array_merge($this->tasksToday, $this->upcomingTasks);
    }

    public function delete(int $id): void
    {
        Agenda::findOrFail($id)->delete();
        $this->loadAgenda();

        session()->flash('success', 'Agenda berhasil dihapus!');
    }

    public function render()
    {
        return view('livewire.agenda.index');
    }
}
