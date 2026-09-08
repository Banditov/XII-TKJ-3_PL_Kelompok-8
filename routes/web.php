<?php

use App\Livewire\Agenda\AgendaIndex;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Perlengkapan\PerlengkapanIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/agenda');
});

Route::get('/login', Login::class)->name('login');
Route::get('/agenda', AgendaIndex::class)->name('agenda');
Route::get('/perlengkapan', PerlengkapanIndex::class)->name('perlengkapan');
Route::get('/admin/register', Register::class)->name('admin.register');