<?php

namespace App\Livewire\Agenda;

use App\Models\Agenda;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'agenda.create'])]
class AgendaCreate extends Component
{
    public string $title = '';

    public string $description = '';

    public string $date = '';

    public string $time = '';

    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'date' => ['required', 'date_format:Y-m-d', 'after_or_equal:today'],
            'time' => ['required', 'date_format:H:i'],
        ];
    }

    protected function messages(): array
    {
        return [
            'title.required' => 'Judul agenda wajib diisi.',
            'title.min' => 'Judul minimal 3 karakter.',
            'date.required' => 'Tanggal wajib diisi.',
            'date.after_or_equal' => 'Tanggal tidak boleh kurang dari hari ini.',
            'time.required' => 'Waktu wajib diisi.',
        ];
    }

    public function mount(): void
    {
        $this->date = now()->format('Y-m-d');
        $this->time = now()->format('H:i');
    }

    public function save(): void
    {
        Agenda::create($this->validate());

        session()->flash('success', 'Agenda berhasil ditambahkan!');
        $this->redirect(route('agenda'));
    }

    public function render()
    {
        return view('livewire.agenda.create');
    }
}
