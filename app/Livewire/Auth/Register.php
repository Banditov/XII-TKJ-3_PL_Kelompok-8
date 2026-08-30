<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Register extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $class = '';

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|min:8',
        'class' => 'required|string|max:50',
    ];

    protected $messages = [
        'name.required' => 'Nama lengkap wajib diisi.',
        'name.min' => 'Nama minimal 3 karakter.',
        'name.max' => 'Nama maksimal 255 karakter.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email ini sudah terdaftar.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'class.required' => 'Silakan pilih kelas.',
        'class.string' => 'Format kelas tidak valid.',
        'class.max' => 'Kelas maksimal 50 karakter.',
    ];

    public function register()
    {
        $this->validate();

        try {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'class' => $this->class,
            ]);

            Auth::login($user);
            session()->regenerate();

            return redirect()->intended('/agenda');

        } catch (\Exception $e) {
            session()->flash('error', 'Registrasi gagal. Silakan coba lagi.');
            return back();
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('layouts.app');
    }
}