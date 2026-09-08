<?php

namespace App\Livewire\Agenda;

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
        'time_end' => 'nullable|after:time',
    ];

    protected $messages = [
        'title.required' => 'Judul agenda wajib diisi.',
        'title.min' => 'Judul minimal 3 karakter.',
        'date.required' => 'Tanggal wajib diisi.',
        'date.after_or_equal' => 'Tanggal tidak boleh kurang dari hari ini.',
        'time.required' => 'Waktu wajib diisi.',
        'time_end.after' => 'Waktu selesai harus setelah waktu mulai.',
    ];

    public function mount()
    {
    }

    public function save()
    {
    }

    public function render()
    {
        return view('livewire.agenda.create');
    }
}