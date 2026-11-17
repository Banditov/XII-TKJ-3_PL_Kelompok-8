<?php
namespace App\Http\Controllers\Auth;

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Google authentication gagal.');
        }

        $student = Student::where('google_id', $googleUser->id)
            ->orWhere('email', $googleUser->email)
            ->first();

        if ($student) {
            if (!$student->google_id) {
                $student->update(['google_id' => $googleUser->id]);
            }

            Auth::guard('student')->login($student);
            session()->regenerate();

            return redirect()->intended('/absent');
        }

        $teacher = Teacher::where('google_id', $googleUser->id)
            ->orWhere('email', $googleUser->email)
            ->first();

        if ($teacher) {
            if (!$teacher->google_id) {
                $teacher->update(['google_id' => $googleUser->id]);
            }

            Auth::guard('teacher')->login($teacher);
            session()->regenerate();

            return redirect()->intended('/absent');
        }

        return redirect('/login')->with(
            'error',
            'Akun Google Anda belum terdaftar. Hubungi administrator.'
        );
    }
}