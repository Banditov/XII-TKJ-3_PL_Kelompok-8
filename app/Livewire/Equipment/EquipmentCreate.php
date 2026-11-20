<?php

namespace App\Livewire\Equipment;

use App\Models\Equipment;
use App\Models\SchoolClass;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app', ['active' => 'equipment'])]
class EquipmentCreate extends Component
{
    public ?int $class_id = null;
    public string $name = '';
    public int $total = 1;
    public string $description = '';
    public $classes = [];
    public string $className = '';

    protected function rules(): array
    {
        return [
            'class_id' => 'required|exists:classes,id',
            'name' => 'required|min:3|max:255',
            'total' => 'required|integer|min:1',
            'description' => 'nullable|max:1000',
        ];
    }

    public function mount(): void
    {
        if (Auth::guard('teacher')->check()) {
            $this->classes = SchoolClass::orderBy('name')->get();
        }

        $this->class_id = request()->query('class_id')
            ?? Auth::guard('student')->user()?->class_id
            ?? SchoolClass::first()?->id;

        $this->className = SchoolClass::find($this->class_id)?->name ?? 'XII TKJ 3';
    }

    public function increment(): void
    {
        $this->total++;
    }

    public function decrement(): void
    {
        if ($this->total > 1) {
            $this->total--;
        }
    }

    public function save(): void
    {
        $this->validate();

        Equipment::create([
            'class_id' => $this->class_id,
            'name' => $this->name,
            'total' => $this->total,
            'description' => $this->description,
        ]);

        $this->dispatch('notify', message: 'Perlengkapan berhasil ditambahkan.', type: 'success');
        $this->redirect(route('equipment.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.equipment.create');
    }
}