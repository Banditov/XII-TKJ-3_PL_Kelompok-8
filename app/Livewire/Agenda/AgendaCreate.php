<?php

namespace App\Livewire\Agenda;

use App\Models\Agenda;
use App\Models\SchoolClass;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app', ['active' => 'agenda'])]
class AgendaCreate extends Component
{
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

    protected function messages(): array
    {
        return [
            'title.required' => 'Judul agenda wajib diisi.',
            'title.min' => 'Judul minimal 3 karakter.',
            'date.required' => 'Tanggal wajib diisi.',
            'time_end.after' => 'Waktu selesai harus setelah waktu mulai.',
        ];
    }

    public function mount(): void
    {
        $this->date = now()->format('Y-m-d');

        $this->selectedClassId = request()->query('class_id') 
            ?? Auth::guard('student')->user()?->class_id 
            ?? SchoolClass::first()?->id;
    }

    public function save(): void
    {
        $this->validate();

        if (!$this->selectedClassId) {
            $this->dispatch('notify', message: 'Kelas tidak ditemukan.', type: 'error');
            return;
        }

        Agenda::create([
            'class_id' => $this->selectedClassId,
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'time' => $this->time ?: null,
            'time_end' => $this->time_end ?: null,
        ]);

        $this->dispatch('notify', message: 'Agenda berhasil ditambahkan.', type: 'success');

        $this->redirect(route('agenda.index', ['class_id' => $this->selectedClassId]), navigate: true);
    }

    public function render()
    {
        return view('livewire.agenda.create');
    }
}