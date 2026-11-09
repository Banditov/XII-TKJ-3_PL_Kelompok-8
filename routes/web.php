<?php

use App\Livewire\Absent\AbsentIndex;
use App\Livewire\Agenda\AgendaCreate;
use App\Livewire\Agenda\AgendaEdit;
use App\Livewire\Agenda\AgendaIndex;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Driver\DriverIndex;
use App\Livewire\Equipment\EquipmentCreate;
use App\Livewire\Equipment\EquipmentEdit;
use App\Livewire\Equipment\EquipmentIndex;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;

Route::get('/', fn () => redirect('/login'));

Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

Route::middleware('guest:student,teacher')->group(function () {
    Route::get('/login', Login::class)->name('login');
});

Route::middleware('auth:student,teacher')->group(function () {
    Route::get('/absent', AbsentIndex::class)->name('absent');
    Route::get('/driver', DriverIndex::class)->name('driver');
    Route::get('/agenda', AgendaIndex::class)->name('agenda.index');
    Route::get('/agenda/create', AgendaCreate::class)->name('agenda.create');
    Route::get('/agenda/{id}/edit', AgendaEdit::class)->name('agenda.edit');
    Route::get('/equipment', EquipmentIndex::class)->name('equipment.index');
    Route::get('/equipment/create', EquipmentCreate::class)->name('equipment.create');
    Route::get('/equipment/{id}/edit', EquipmentEdit::class)->name('equipment.edit');
});

Route::middleware('auth:teacher')->group(function () {
    Route::get('/admin/register', Register::class)->name('register');
});

Route::post('/logout', function () {
    Auth::guard('student')->logout();
    Auth::guard('teacher')->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');