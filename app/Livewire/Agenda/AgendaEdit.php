<?php

namespace App\Livewire\Agenda;

use App\Models\Agenda;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'agenda.edit'])]
class AgendaEdit extends Component
{
    public ?int $agendaId = null;

    public string $title = '';

    public string $description = '';

    public string $date = '';

    public string $time = '';

    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'date' => ['required', 'date_format:Y-m-d'],
            'time' => ['required', 'date_format:H:i'],
        ];
    }

    protected function messages(): array
    {
        return [
            'title.required' => 'Judul agenda wajib diisi.',
            'title.min' => 'Judul minimal 3 karakter.',
            'date.required' => 'Tanggal wajib diisi.',
            'time.required' => 'Waktu wajib diisi.',
        ];
    }

    public function mount(int $id): void
    {
        $this->agendaId = $id;

        $agenda = Agenda::findOrFail($id);

        $this->title = $agenda->title;
        $this->description = $agenda->description ?? '';
        $this->date = $agenda->date;
        $this->time = substr($agenda->time, 0, 5);
    }

    public function update(): void
    {
        $agenda = Agenda::findOrFail($this->agendaId);
        $agenda->update($this->validate());

        session()->flash('success', 'Agenda berhasil diperbarui!');
        $this->redirect(route('agenda'));
    }

    public function delete(): void
    {
        Agenda::findOrFail($this->agendaId)->delete();

        session()->flash('success', 'Agenda berhasil dihapus!');
        $this->redirect(route('agenda'));
    }

    public function render()
    {
        return view('livewire.agenda.edit');
    }
}
