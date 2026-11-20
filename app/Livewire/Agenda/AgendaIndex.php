<?php

namespace App\Livewire\Agenda;

use App\Models\Agenda;
use App\Models\SchoolClass;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Livewire\ConfirmModal;

#[Layout('layouts.app', ['active' => 'agenda'])]
class AgendaIndex extends Component
{
    public array $tasksToday = [];
    public array $upcomingTasks = [];
    public array $lateTasks = [];
    public ?int $selectedClassId = null;
    protected $listeners = ['delete-confirmed' => 'delete'];

    public function confirmDelete(int $id, string $title)
    {
        $this->dispatch('open-confirm-modal', [
            'title' => 'Hapus Agenda',
            'message' => "Apakah Anda yakin ingin menghapus agenda \"{$title}\"? Tindakan ini tidak dapat dibatalkan.",
            'confirmText' => 'Ya, Hapus',
            'actionEvent' => 'delete-confirmed',
            'actionPayload' => ['id' => $id],
        ])->to(ConfirmModal::class);
    }

    public function delete(int $id): void
    {
        $agenda = Agenda::find($id);
        if ($agenda) {
            $agenda->delete();
            $this->dispatch('notify', message: 'Agenda berhasil dihapus.', type: 'success');
            $this->loadTasks();
        }
    }

    public function mount(): void
    {
        if (Auth::guard('student')->check()) {
            $this->selectedClassId = Auth::guard('student')->user()->class_id;
        } else {
            $this->selectedClassId = SchoolClass::first()?->id;
        }

        $this->loadTasks();
    }

    public function updatedSelectedClassId(): void
    {
        $this->loadTasks();
    }

    public function loadTasks(): void
    {
        if (!$this->selectedClassId) {
            $this->tasksToday = [];
            $this->upcomingTasks = [];
            $this->lateTasks = [];
            return;
        }

        $today = now()->format('Y-m-d');
        $future = now()->addDay()->format('Y-m-d');

        $base = Agenda::where('class_id', $this->selectedClassId);

        $this->tasksToday = $base->clone()
            ->whereDate('date', $today)
            ->orderBy('time')
            ->get()
            ->toArray();

        $this->upcomingTasks = $base->clone()
            ->whereDate('date', '>=', $future)
            ->orderBy('date')
            ->orderBy('time')
            ->get()
            ->toArray();

        $this->lateTasks = $base->clone()
            ->whereDate('date', '<', $today)
            ->orderByDesc('date')
            ->get()
            ->toArray();
    }

    public function getTasksNowProperty(): array
    {
        return array_merge($this->tasksToday, $this->upcomingTasks);
    }

    public function getClassNameProperty(): string
    {
        return SchoolClass::find($this->selectedClassId)?->name ?? '-';
    }

    private function canEdit(Agenda $agenda): bool
    {
        if (Auth::guard('student')->check()) {
            return Auth::guard('student')->user()->class_id === $agenda->class_id;
        }

        return Auth::guard('teacher')->check();
    }

    public function render()
    {
        return view('livewire.agenda.index', [
            'classes' => Auth::guard('teacher')->check() 
                ? SchoolClass::orderBy('name')->get() 
                : collect(),
        ]);
    }
}