<?php
namespace App\Livewire\Auth;

use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\Teacher;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class Register extends Component
{
    public $role = 'student';
    public $name = '';
    public $email = '';
    public $password = '';
    public $class_id = '';

    protected function rules(): array
    {
        return [
            'role' => ['required', Rule::in(['student', 'teacher'])],
            'name' => 'required|min:3|max:255',
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('students', 'email'),
                Rule::unique('teachers', 'email'),
            ],
            'password' => ['required', Password::min(8)],

            'class_id' => $this->role === 'student'
                ? 'required|exists:classes,id'
                : 'nullable',
        ];
    }

    protected function messages(): array
    {
        return [
            'role.required' => 'Pilih tipe akun.',
            'role.in' => 'Tipe akun tidak valid.',
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.min' => 'Nama minimal 3 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'class_id.required' => 'Silakan pilih kelas.',
            'class_id.exists' => 'Kelas tidak valid.',
        ];
    }

    public function register()
    {
        $this->validate();

        if ($this->role === 'student') {
            Student::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'class_id' => $this->class_id,
            ]);
        } else {
            Teacher::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
            ]);
        }

        session()->flash('notify', [
            'message' => 'Akun ' . $this->role . ' berhasil dibuat.',
            'type' => 'success',
        ]);

        $this->reset(['name', 'email', 'password', 'class_id', 'role']);

        return redirect()->route('register');
    }

    public function render()
    {
        return view('livewire.auth.register', [
            'classes' => SchoolClass::orderBy('name')->get(),
        ])->layout('layouts.app-center');
    }
}