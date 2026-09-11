<?php
namespace App\Livewire\Agenda;

use App\Data\AgendaData;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'agenda.create'])]
class AgendaCreate extends Component
{
    public $title = '';
    public $description = '';
    public $date = '';
    public $time = '';
    public $time_end = '';

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'description' => 'nullable|max:1000',
        'date' => 'required|date|after_or_equal:today',
        'time' => 'required',
    ];

    protected $messages = [
        'title.required' => 'Judul agenda wajib diisi.',
        'title.min' => 'Judul minimal 3 karakter.',
        'date.required' => 'Tanggal wajib diisi.',
        'date.after_or_equal' => 'Tanggal tidak boleh kurang dari hari ini.',
        'time.required' => 'Waktu wajib diisi.',
    ];

    public function mount(): void
    {
        $this->date = now()->format('Y-m-d');
        $this->time = now()->format('H:i');
    }

    public function save(): void
    {
        $this->validate();

        try {
            session()->flash('success', 'Agenda berhasil ditambahkan!');

            $this->redirect(route('agenda.index'));
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menambahkan agenda. Silakan coba lagi.');
        }
    }

    public function render()
    {
        return view('livewire.agenda.create');
    }
}