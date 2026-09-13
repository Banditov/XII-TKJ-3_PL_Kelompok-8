<?php
namespace App\Livewire\Absent;

use App\Data\AbsentData;
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
        $this->students = AbsentData::students();
    }

    public function getBanyakSiswaProperty(): int
    {
        return AbsentData::totalStudents();
    }

    public function getSudahAbsenProperty(): int
    {
        return AbsentData::attendedCount();
    }

    public function getBelumAbsenProperty(): int
    {
        return AbsentData::notAttendedCount();
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
        $this->students = AbsentData::students();
    }

    public function render()
    {
        return view('livewire.absent.index');
    }
}