<?php

namespace App\Livewire\Absent;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'absent'])]
class AbsentIndex extends Component
{
    public string $selectedDate;

    public string $myStatus = 'Belum Absen';

    public array $students = [
        ['nama' => 'Christopher Vittorio C.', 'nis' => '2024001', 'status' => 'hadir', 'reason' => null],
        ['nama' => 'Michelle Nathaliu', 'nis' => '2024002', 'status' => 'izin', 'reason' => 'Sakit'],
        ['nama' => 'Valentino', 'nis' => '2024003', 'status' => 'belum', 'reason' => null],
    ];

    public function mount(): void
    {
        $this->selectedDate = now()->format('Y-m-d');
    }

    public function getBanyakSiswaProperty(): int
    {
        return count($this->students);
    }

    public function getSudahAbsenProperty(): int
    {
        return collect($this->students)->whereIn('status', ['hadir', 'izin'])->count();
    }

    public function getBelumAbsenProperty(): int
    {
        return collect($this->students)->where('status', 'belum')->count();
    }

    public function absenMasuk(): void
    {
        $this->myStatus = 'Hadir';
    }

    public function ajukanIzin(): void
    {
        $this->myStatus = 'Izin';
    }

    public function render()
    {
        return view('livewire.absent.index');
    }
}