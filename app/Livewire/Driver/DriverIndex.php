<?php

namespace App\Livewire\Driver;

use App\Data\StudentData;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'driver'])]
class DriverIndex extends Component
{
    public array $students = [];

    public function mount(): void
    {
        $this->students = StudentData::all();
    }

    public function getTotalStudentsProperty(): int
    {
        return StudentData::total();
    }

    public function getHasSimProperty(): int
    {
        return StudentData::hasSimCount();
    }

    public function getNoSimProperty(): int
    {
        return StudentData::noSimCount();
    }

    public function render()
    {
        return view('livewire.driver.index');
    }
}