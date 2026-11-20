<?php

namespace App\Livewire\Driver;

use App\Models\Student;
use App\Models\SchoolClass;
use App\Livewire\ConfirmModal;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app', ['active' => 'driver'])]
class DriverIndex extends Component
{
    use WithFileUploads;

    public ?int $selectedClassId = null;
    public $totalStudents;
    public $hasSimCount;
    public $noSimCount;

    public $simImage;

    protected $listeners = ['delete-confirmed' => 'delete'];

    public function mount(): void
    {
        if (Auth::guard('student')->check()) {
            $this->selectedClassId = Auth::guard('student')->user()->class_id;
        } else {
            $this->selectedClassId = SchoolClass::first()?->id;
        }

        $this->loadCounts();
    }

    public function updatedSelectedClassId(): void
    {
        $this->loadCounts();
    }

    public function loadCounts(): void
    {
        if (!$this->selectedClassId) return;

        $query = Student::where('class_id', $this->selectedClassId);

        $this->totalStudents = $query->clone()->count();
        $this->hasSimCount = $query->clone()->whereNotNull('sim_card_path')->count();
        $this->noSimCount = $query->clone()->whereNull('sim_card_path')->count();
    }

    public function confirmDelete(int $id, string $name)
    {
        $this->dispatch('open-confirm-modal', [
            'title' => 'Hapus Data SIM',
            'message' => "Apakah Anda yakin ingin menghapus foto SIM milik \"{$name}\"? Tindakan ini tidak dapat dibatalkan.",
            'confirmText' => 'Ya, Hapus',
            'actionEvent' => 'delete-confirmed',
            'actionPayload' => ['id' => $id],
        ])->to(ConfirmModal::class);
    }

    public function delete(int $id): void
    {
        $student = Student::find($id);
        if ($student && $student->sim_card_path) {
            Storage::disk('public')->delete($student->sim_card_path);
            $student->update(['sim_card_path' => null]);
            
            $this->dispatch('notify', message: 'Data SIM berhasil dihapus.', type: 'success');
            $this->loadCounts();
        }
    }

    public function updatedSimImage()
    {
        $this->validate(['simImage' => 'image|max:2048']);

        $student = Auth::guard('student')->user();

        if ($student->sim_card_path) {
            Storage::disk('public')->delete($student->sim_card_path);
        }

        $path = $this->simImage->store('sim_images', 'public');
        $student->update(['sim_card_path' => $path]);

        $this->reset('simImage');
        $this->loadCounts();
        $this->dispatch('notify', message: 'Foto SIM berhasil diunggah.', type: 'success');
    }

    public function removeMyImage()
    {
        $student = Auth::guard('student')->user();
        if ($student->sim_card_path) {
            Storage::disk('public')->delete($student->sim_card_path);
            $student->update(['sim_card_path' => null]);
            $this->loadCounts();
            $this->dispatch('notify', message: 'Foto SIM dihapus.', type: 'success');
        }
    }

    public function getClassNameProperty(): string
    {
        return SchoolClass::find($this->selectedClassId)?->name ?? '-';
    }

    public function render()
    {
        return view('livewire.driver.index', [
            'students' => Student::where('class_id', $this->selectedClassId)->orderBy('name')->get(),
            'classes' => Auth::guard('teacher')->check() ? SchoolClass::orderBy('name')->get() : collect(),
        ]);
    }
}