<?php

namespace App\Livewire\Driver;

use App\Models\SimRecord;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'driver'])]
class DriverIndex extends Component
{
    #[Locked]
    public ?int $editingId = null;

    public string $name = '';

    public string $nis = '';

    public bool $hasSim = false;

    public bool $showForm = false;

    public function create(): void
    {
        $this->resetForm();
        $this->showForm = true;
    }

    public function edit(int $id): void
    {
        $record = SimRecord::findOrFail($id);

        $this->resetValidation();
        $this->editingId = $record->id;
        $this->name = $record->name;
        $this->nis = $record->nis;
        $this->hasSim = $record->has_sim;
        $this->showForm = true;
    }

    public function save(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'nis' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sim_records', 'nis')->ignore($this->editingId),
            ],
            'hasSim' => ['boolean'],
        ], [
            'name.required' => 'Nama siswa wajib diisi.',
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah terdaftar.',
        ]);

        $record = $this->editingId
            ? SimRecord::findOrFail($this->editingId)
            : new SimRecord;

        $record->fill([
            'name' => $validated['name'],
            'nis' => $validated['nis'],
            'has_sim' => $validated['hasSim'],
        ])->save();

        session()->flash('success', $this->editingId
            ? 'Data SIM siswa berhasil diperbarui.'
            : 'Data SIM siswa berhasil ditambahkan.');

        $this->resetForm();
    }

    public function delete(int $id): void
    {
        SimRecord::findOrFail($id)->delete();

        if ($this->editingId === $id) {
            $this->resetForm();
        }

        session()->flash('success', 'Data SIM siswa berhasil dihapus.');
    }

    public function cancel(): void
    {
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->resetValidation();
        $this->editingId = null;
        $this->name = '';
        $this->nis = '';
        $this->hasSim = false;
        $this->showForm = false;
    }

    public function render()
    {
        return view('livewire.driver.index', [
            'students' => SimRecord::query()->orderBy('name')->get(),
            'totalStudents' => SimRecord::count(),
            'hasSimCount' => SimRecord::where('has_sim', true)->count(),
            'noSimCount' => SimRecord::where('has_sim', false)->count(),
        ]);
    }
}
