<?php

namespace App\Livewire\Auth;

use Livewire\Component;

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
        'class' => 'required',
    ];

    public function register()
    {
        $this->validate();
        
        // Your registration logic here
        // ...
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('layouts.app');
    }
}