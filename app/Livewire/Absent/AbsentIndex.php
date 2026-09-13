<?php

namespace App\Livewire\Absent;

use App\Data\StudentData;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'absent'])]
class AbsentIndex extends Component
{
    public string $selectedDate;
    public string $myStatus = 'Belum Absen';
    public array $students = [];

    public function mount(): void
    {
        $this->selectedDate = now()->format('Y-m-d');
        $this->students = StudentData::all();
    }

    public function getBanyakSiswaProperty(): int
    {
        return StudentData::total();
    }

    public function getSudahAbsenProperty(): int
    {
        return StudentData::attendedCount();
    }

    public function getBelumAbsenProperty(): int
    {
        return StudentData::notAttendedCount();
    }

    public function absenMasuk(): void
    {
        $this->myStatus = 'Hadir';
        session()->flash('success', 'Berhasil absen masuk!');
    }

    public function ajukanIzin(): void
    {
        $this->myStatus = 'Izin';
        session()->flash('success', 'Pengajuan izin terkirim!');
    }

    public function updatedSelectedDate(): void
    {
        $this->students = StudentData::all();
    }

    public function render()
    {
        return view('livewire.absent.index');
    }
}