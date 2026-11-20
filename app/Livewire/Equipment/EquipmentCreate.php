<?php

namespace App\Livewire\Equipment;

use App\Models\Equipment;
use App\Models\SchoolClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app', ['active' => 'equipment.create'])]
class EquipmentCreate extends Component
{
    private const MAX_TOTAL = 100000;

    public ?int $class_id = null;
    public string $name = '';
    public ?int $total = 1;
    public string $description = '';

    protected function rules(): array
    {
        return [
            'class_id' => 'required|exists:classes,id',
            'name' => [
                'required',
                'min:3',
                'max:255',
                Rule::unique('equipment', 'name')->where('class_id', $this->class_id),
            ],
            'total' => 'required|integer|min:1|max:100000',
            'description' => 'nullable|max:1000',
        ];
    }

    protected $messages = [
        'class_id.required' => 'Silakan pilih kelas.',
        'class_id.exists' => 'Kelas tidak valid.',
        'name.required' => 'Nama peralatan wajib diisi.',
        'name.min' => 'Nama minimal 3 karakter.',
        'name.unique' => 'Perlengkapan dengan nama ini sudah ada di kelas tersebut.',
        'total.required' => 'Total wajib diisi.',
        'total.integer' => 'Total harus berupa angka bulat.',
        'total.min' => 'Total minimal 1.',
        'total.max' => 'Total maksimal 100000.',
    ];

    public function mount(): void
    {
        $this->total = 1;

        if ($student = Auth::guard('student')->user()) {
            $this->class_id = (int) $student->class_id;
        }
    }

    public function increment(): void
    {
        $this->total = min(self::MAX_TOTAL, ($this->total ?? 0) + 1);
    }

    public function decrement(): void
    {
        $this->total = max(1, ($this->total ?? 1) - 1);
    }

    public function save(): void
    {
        if ($student = Auth::guard('student')->user()) {
            $this->class_id = (int) $student->class_id;
        } else {
            abort_unless(Auth::guard('teacher')->check(), 403);
        }

        $this->name = trim($this->name);
        $this->validate();

        try {
            Equipment::create([
                'class_id' => $this->class_id,
                'name' => $this->name,
                'total' => $this->total,
                'description' => trim($this->description) ?: null,
            ]);
        } catch (\Throwable $e) {
            report($e);
            session()->flash('error', 'Gagal menambahkan peralatan. Silakan coba lagi.');
            return;
        }

        session()->flash('success', 'Peralatan berhasil ditambahkan!');
        $this->redirect(route('equipment.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.equipment.create', [
            'classes' => SchoolClass::orderBy('name')->get(),
        ]);
    }
}