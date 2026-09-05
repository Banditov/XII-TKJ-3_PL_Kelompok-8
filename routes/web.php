<?php

use App\Livewire\Agenda\AgendaIndex;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/agenda');
});

Route::get('/login', Login::class)->name('login');
Route::get('/agenda', AgendaIndex::class)->name('agenda');
Route::get('/admin/register', Register::class)->name('admin.register');