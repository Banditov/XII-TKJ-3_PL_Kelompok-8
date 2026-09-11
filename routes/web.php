<?php

use App\Livewire\Agenda\AgendaIndex;
use App\Livewire\Agenda\AgendaCreate;
use App\Livewire\Agenda\AgendaEdit;
use App\Livewire\Absent\AbsentIndex;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Perlengkapan\PerlengkapanIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', Login::class)->name('login');
Route::get('/admin/register', Register::class)->name('admin.register');

Route::get('/agenda', AgendaIndex::class)->name('agenda');
Route::get('/agenda/create', AgendaCreate::class)->name('agenda.create');
Route::get('/agenda/{id}/edit', AgendaEdit::class)->name('agenda.edit');

Route::get('/absent', AbsentIndex::class)->name('absent');

Route::get('/perlengkapan', PerlengkapanIndex::class)->name('perlengkapan');
