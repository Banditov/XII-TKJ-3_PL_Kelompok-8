<?php

namespace App\Livewire\Equipment;

use App\Models\Equipment;
use App\Models\SchoolClass;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Livewire\ConfirmModal;

#[Layout('layouts.app', ['active' => 'equipment'])]
class EquipmentIndex extends Component
{
    public array $equipment = [];
    public ?int $classId = null;
    public array $classes = [];
    public string $className = '-';
    protected $listeners = ['delete-confirmed' => 'delete'];

    public function confirmDelete(int $id, string $title)
    {
        $this->dispatch('open-confirm-modal', [
            'title' => 'Hapus Agenda',
            'message' => "Apakah Anda yakin ingin menghapus agenda \"{$title}\"? Tindakan ini tidak dapat dibatalkan.",
            'confirmText' => 'Ya, Hapus',
            'actionEvent' => 'delete-confirmed',
            'actionPayload' => ['id' => $id],
        ])->to(ConfirmModal::class);
    }

    public function delete(int $id): void
    {
        $item = Equipment::find($id);
        if ($item) {
            $item->delete();
            $this->dispatch('notify', message: 'Perlengkapan berhasil dihapus.', type: 'success');
            $this->loadData();
        }
    }

    public function mount(): void
    {
        $this->loadData();
    }

    public function updatedClassId(): void
    {
        $this->loadData();
    }

    public function loadData(): void
    {
        if (Auth::guard('student')->check()) {
            $this->classId = Auth::guard('student')->user()->class_id;
            $this->classes = []; 
        } else {
            $this->classes = SchoolClass::orderBy('name')->get()->toArray();

            if (!$this->classId && count($this->classes) > 0) {
                $this->classId = $this->classes[0]['id'];
            }
        }

        $this->className = SchoolClass::find($this->classId)?->name ?? '-';

        if ($this->classId) {
            $this->equipment = Equipment::where('class_id', $this->classId)
                ->orderBy('name')
                ->get()
                ->toArray();
        } else {
            $this->equipment = [];
        }
    }

    public function increment(int $id): void
    {
        $item = Equipment::find($id);
        if ($item) {
            $item->increment('total');
            $this->loadData();
        }
    }

    public function decrement(int $id): void
    {
        $item = Equipment::find($id);
        if ($item && $item->total > 0) {
            $item->decrement('total');
            $this->loadData();
        }
    }

    public function render()
    {
        return view('livewire.equipment.index');
    }
}