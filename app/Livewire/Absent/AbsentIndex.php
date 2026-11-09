<?php
namespace App\Livewire\Absent;

use App\Models\Absent;
use App\Models\SchoolClass;
use App\Models\Student;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.app', ['active' => 'absent'])]
class AbsentIndex extends Component
{
    public string $selectedDate;
    public array $students = [];
    public ?int $selectedClassId = null;

    // Permission state
    public bool $showPermissionForm = false;
    public string $permissionReason = '';

    public function mount(): void
    {
        $this->selectedDate = now()->format('Y-m-d');

        $student = Auth::guard('student')->user();
        if ($student) {
            $this->selectedClassId = $student->class_id;
        }

        $this->loadStudents();
    }

    public function updatedSelectedDate(): void
    {
        $this->loadStudents();
    }

    public function updatedSelectedClassId(): void
    {
        $this->loadStudents();
    }

    public function loadStudents(): void
    {
        $date = $this->selectedDate;

        $query = Student::with(['absents' => function ($q) use ($date) {
                $q->where('date', $date);
            }, 'schoolClass']);

        if (!Auth::guard('teacher')->check()) {
            $query->where('class_id', Auth::guard('student')->user()->class_id);
        } elseif ($this->selectedClassId) {
            $query->where('class_id', $this->selectedClassId);
        }

        $this->students = $query
            ->orderBy('name')
            ->get()
            ->map(function ($s) {
                $absent = $s->absents->first();

                return [
                    'id' => $s->id,
                    'name' => $s->name,
                    'class' => $s->schoolClass?->name ?? '-',
                    'status' => $absent?->status ?? 'belum',
                    'reason' => $absent?->reason,
                ];
            })
            ->toArray();
    }

    public function getStudentTotalProperty(): int
    {
        return count($this->students);
    }

    public function getAbsentProperty(): int
    {
        return collect($this->students)
            ->whereIn('status', ['hadir', 'izin', 'sakit'])
            ->count();
    }

    public function getNotAbsentProperty(): int
    {
        return collect($this->students)->where('status', 'belum')->count();
    }

    public function getMyStatusProperty(): string
    {
        $student = Auth::guard('student')->user();
        if (!$student) return '-';

        $absent = Absent::where('student_id', $student->id)
            ->where('date', $this->selectedDate)
            ->first();

        return match ($absent?->status) {
            'hadir' => 'Hadir',
            'izin'  => 'Izin',
            'sakit' => 'Sakit',
            'alpha' => 'Alpha',
            default => 'Belum Absen',
        };
    }

    public function getClassLabelProperty(): string
    {
        if (Auth::guard('student')->check()) {
            return Auth::guard('student')->user()->schoolClass?->name ?? '-';
        }

        if ($this->selectedClassId) {
            return SchoolClass::find($this->selectedClassId)?->name ?? 'Semua Kelas';
        }

        return 'Semua Kelas';
    }

    public function absent(): void
    {
        $student = Auth::guard('student')->user();
        if (!$student) return;

        if ($this->selectedDate !== now()->format('Y-m-d')) {
            $this->dispatch('notify', message: 'Hanya bisa absen untuk hari ini.', type: 'error');
            return;
        }

        Absent::updateOrCreate(
            ['student_id' => $student->id, 'date' => $this->selectedDate],
            ['status' => 'hadir', 'reason' => null]
        );

        $this->showPermissionForm = false;
        $this->permissionReason = '';
        $this->loadStudents();
        $this->dispatch('notify', message: 'Berhasil absen masuk!', type: 'success');
    }

    public function openPermissionForm(): void
    {
        $this->showPermissionForm = true;
        $this->permissionReason = '';
    }

    public function cancelPermission(): void
    {
        $this->showPermissionForm = false;
        $this->permissionReason = '';
    }

    public function permission(): void
    {
        $student = Auth::guard('student')->user();
        if (!$student) return;

        if ($this->selectedDate !== now()->format('Y-m-d')) {
            $this->dispatch('notify', message: 'Hanya bisa mengajukan izin untuk hari ini.', type: 'error');
            return;
        }

        $this->validate([
            'permissionReason' => 'required|min:5|max:255',
        ], [
            'permissionReason.required' => 'Alasan izin wajib diisi.',
            'permissionReason.min' => 'Alasan izin minimal 5 karakter.',
            'permissionReason.max' => 'Alasan izin maksimal 255 karakter.',
        ]);

        Absent::updateOrCreate(
            ['student_id' => $student->id, 'date' => $this->selectedDate],
            ['status' => 'izin', 'reason' => $this->permissionReason]
        );

        $this->showPermissionForm = false;
        $this->permissionReason = '';
        $this->loadStudents();
        $this->dispatch('notify', message: 'Pengajuan izin terkirim.', type: 'success');
    }

    public function render()
    {
        return view('livewire.absent.index', [
            'classes' => Auth::guard('teacher')->check()
                ? SchoolClass::orderBy('name')->get()
                : collect(),
        ]);
    }
}