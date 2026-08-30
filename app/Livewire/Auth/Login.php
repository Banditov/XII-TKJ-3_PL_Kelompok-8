<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    private $dummyUsers = [
        'admin@example.com' => [
            'password' => 'password123',
            'name' => 'Admin User',
            'role' => 'admin',
        ],
        'user@example.com' => [
            'password' => 'password123',
            'name' => 'Regular User',
            'role' => 'user',
        ],
        'teacher@example.com' => [
            'password' => 'password123',
            'name' => 'Teacher User',
            'role' => 'teacher',
        ],
    ];

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (isset($this->dummyUsers[$this->email])) {
            $user = $this->dummyUsers[$this->email];

            if ($this->password === $user['password']) {
                session()->put('dummy_logged_in', true);
                session()->put('dummy_user', [
                    'id' => rand(1, 100),
                    'name' => $user['name'],
                    'email' => $this->email,
                    'role' => $user['role'],
                ]);

                session()->regenerate();
                return redirect()->intended('/dashboard');
            }
        }

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        $this->addError('email', 'The provided credentials do not match our records.');
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.app');
    }
}