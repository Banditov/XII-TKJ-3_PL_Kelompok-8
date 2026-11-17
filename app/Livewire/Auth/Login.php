<?php
namespace App\Livewire\Auth;

use App\Services\QuoteService;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public $quote = [];

    public function mount(QuoteService $quoteService)
    {
        $this->quote = $quoteService->getRandomQuote();
    }

    public function refreshQuote(QuoteService $quoteService)
    {
        $this->quote = $quoteService->refreshQuote();
    }

    protected $messages = [
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 6 karakter.',
    ];

    public function login()
    {
        $this->validate();

        $user = null;
        $guard = null;

        if (Auth::guard('student')->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember)) {
            $user = Auth::guard('student')->user();
            $guard = 'student';
        } elseif (Auth::guard('teacher')->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember)) {
            $user = Auth::guard('teacher')->user();
            $guard = 'teacher';
        }

        if (!$user) {
            $this->addError('email', 'Email atau password salah.');
            return;
        }

        session()->regenerate();

        session()->flash('notify', [
            'message' => 'Welcome, ' . $user->name . '!',
            'type' => 'success',
        ]);

        return redirect()->intended('/absent');
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.app-center');
    }
}