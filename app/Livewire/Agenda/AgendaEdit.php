<?php
namespace App\Livewire\Agenda;

use App\Data\AgendaData;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'agenda.edit'])]
class AgendaEdit extends Component
{
    public ?int $agendaId = null;
    public $title = '';
    public $description = '';
    public $date = '';
    public $time = '';

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'description' => 'nullable|max:1000',
        'date' => 'required|date',
        'time' => 'required',
    ];

    protected $messages = [
        'title.required' => 'Judul agenda wajib diisi.',
        'title.min' => 'Judul minimal 3 karakter.',
        'date.required' => 'Tanggal wajib diisi.',
        'time.required' => 'Waktu wajib diisi.',
    ];

    public function mount(int $id): void
    {
        $this->agendaId = $id;

        $agenda = AgendaData::find($id);

        if (!$agenda) {
            abort(404, 'Agenda tidak ditemukan.');
        }

        $this->title = $agenda['title'];
        $this->description = $agenda['description'] ?? '';
        $this->date = $agenda['date'];
        $this->time = $agenda['time'];
    }

    public function update(): void
    {
        $this->validate();

        $this->redirect(route('agenda.index'));
    }

    public function delete(): void
    {
        $this->redirect(route('agenda.index'));
    }

    public function render()
    {
        return view('livewire.agenda.edit');
    }
}