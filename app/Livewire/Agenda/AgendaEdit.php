<?php

namespace App\Livewire\Agenda;

use App\Models\Agenda;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'agenda'])]
class AgendaEdit extends Component
{
    public ?int $agendaId = null;
    public ?int $selectedClassId = null;
    public string $title = '';
    public string $description = '';
    public string $date = '';
    public string $time = '';
    public string $time_end = '';

    protected function rules(): array
    {
        return [
            'title' => 'required|min:3|max:255',
            'description' => 'nullable|max:1000',
            'date' => 'required|date',
            'time' => 'nullable|date_format:H:i',
            'time_end' => 'nullable|date_format:H:i|after:time',
        ];
    }

    public function mount(int $id): void
    {
        $agenda = Agenda::findOrFail($id);

        $this->agendaId = $agenda->id;
        $this->selectedClassId = $agenda->class_id;
        $this->title = $agenda->title;
        $this->description = $agenda->description ?? '';
        $this->date = $agenda->date->format('Y-m-d');
        $this->time = $agenda->time ? $agenda->time->format('H:i') : '';
        $this->time_end = $agenda->time_end ? $agenda->time_end->format('H:i') : '';
    }

    public function update(): void
    {
        $this->validate();

        $agenda = Agenda::findOrFail($this->agendaId);
        $agenda->update([
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'time' => $this->time ?: null,
            'time_end' => $this->time_end ?: null,
        ]);

        $this->dispatch('notify', message: 'Agenda berhasil diperbarui.', type: 'success');

        $this->redirect(route('agenda.index', ['class_id' => $this->selectedClassId]), navigate: true);
    }

    public function delete(): void
    {
        Agenda::findOrFail($this->agendaId)->delete();

        $this->dispatch('notify', message: 'Agenda berhasil dihapus.', type: 'success');

        $this->redirect(route('agenda.index', ['class_id' => $this->selectedClassId]), navigate: true);
    }

    public function render()
    {
        return view('livewire.agenda.edit');
    }
}