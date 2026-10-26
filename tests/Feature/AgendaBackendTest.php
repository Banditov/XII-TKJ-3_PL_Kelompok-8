<?php

use App\Livewire\Agenda\AgendaCreate;
use App\Livewire\Agenda\AgendaEdit;
use App\Livewire\Agenda\AgendaIndex;
use App\Models\Agenda;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('a valid agenda can be created', function () {
    Livewire::test(AgendaCreate::class)
        ->set('title', 'Class meeting')
        ->set('description', 'Discuss the upcoming trip.')
        ->set('date', now()->toDateString())
        ->set('time', '10:30')
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('agenda'));

    $this->assertDatabaseHas('agendas', [
        'title' => 'Class meeting',
        'description' => 'Discuss the upcoming trip.',
        'date' => now()->toDateString(),
        'time' => '10:30',
    ]);
});

test('an agenda can be updated', function () {
    $agenda = Agenda::create([
        'title' => 'Old title',
        'description' => null,
        'date' => now()->toDateString(),
        'time' => '08:00',
    ]);

    Livewire::test(AgendaEdit::class, ['id' => $agenda->id])
        ->set('title', 'Updated title')
        ->set('description', 'Updated description')
        ->set('date', now()->addDay()->toDateString())
        ->set('time', '11:45')
        ->call('update')
        ->assertHasNoErrors()
        ->assertRedirect(route('agenda'));

    $this->assertDatabaseHas('agendas', [
        'id' => $agenda->id,
        'title' => 'Updated title',
        'description' => 'Updated description',
        'date' => now()->addDay()->toDateString(),
        'time' => '11:45',
    ]);
});

test('an agenda can be deleted from the list', function () {
    $agenda = Agenda::create([
        'title' => 'Remove this agenda',
        'date' => now()->toDateString(),
        'time' => '08:00',
    ]);

    Livewire::test(AgendaIndex::class)
        ->call('delete', $agenda->id)
        ->assertHasNoErrors();

    $this->assertDatabaseMissing('agendas', ['id' => $agenda->id]);
});

test('agenda dates in the past, today, and the future are grouped correctly', function () {
    $past = Agenda::create([
        'title' => 'Past agenda',
        'date' => now()->subDay()->toDateString(),
        'time' => '08:00',
    ]);
    $today = Agenda::create([
        'title' => 'Today agenda',
        'date' => now()->toDateString(),
        'time' => '09:00',
    ]);
    $future = Agenda::create([
        'title' => 'Future agenda',
        'date' => now()->addDay()->toDateString(),
        'time' => '10:00',
    ]);

    Livewire::test(AgendaIndex::class)
        ->assertSet('lateTasks.0.id', $past->id)
        ->assertSet('tasksToday.0.id', $today->id)
        ->assertSet('upcomingTasks.0.id', $future->id);
});

test('the agenda page renders saved agendas', function () {
    Agenda::create([
        'title' => 'Persisted agenda',
        'description' => 'Visible on the agenda page.',
        'date' => now()->toDateString(),
        'time' => '09:00',
    ]);

    $this->get(route('agenda'))
        ->assertOk()
        ->assertSee('Persisted agenda')
        ->assertSee('Visible on the agenda page.');
});
