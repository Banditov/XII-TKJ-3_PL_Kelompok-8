<?php

use App\Livewire\Driver\DriverIndex;
use App\Models\SimRecord;
use Database\Seeders\SimRecordSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('a SIM record can be created and shown on the page', function () {
    Livewire::test(DriverIndex::class)
        ->call('create')
        ->set('name', 'Nadia Putri')
        ->set('nis', '2024999')
        ->set('hasSim', true)
        ->call('save')
        ->assertHasNoErrors()
        ->assertSet('showForm', false);

    $this->assertDatabaseHas('sim_records', [
        'name' => 'Nadia Putri',
        'nis' => '2024999',
        'has_sim' => true,
    ]);

    $this->get(route('driver'))
        ->assertOk()
        ->assertSee('Nadia Putri')
        ->assertSee('2024999')
        ->assertSee('Memiliki SIM');
});

test('a SIM record can be updated', function () {
    $record = SimRecord::create([
        'name' => 'Old name',
        'nis' => '2024001',
        'has_sim' => false,
    ]);

    Livewire::test(DriverIndex::class)
        ->call('edit', $record->id)
        ->set('name', 'Updated name')
        ->set('hasSim', true)
        ->call('save')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('sim_records', [
        'id' => $record->id,
        'name' => 'Updated name',
        'nis' => '2024001',
        'has_sim' => true,
    ]);
});

test('a SIM record cannot be saved with a duplicate NIS', function () {
    SimRecord::create([
        'name' => 'Existing student',
        'nis' => '2024001',
        'has_sim' => false,
    ]);

    Livewire::test(DriverIndex::class)
        ->call('create')
        ->set('name', 'Another student')
        ->set('nis', '2024001')
        ->call('save')
        ->assertHasErrors(['nis' => 'unique']);
});

test('a SIM record can be deleted and the summary counts reflect the database', function () {
    $hasSim = SimRecord::create([
        'name' => 'Student with SIM',
        'nis' => '2024001',
        'has_sim' => true,
    ]);
    SimRecord::create([
        'name' => 'Student without SIM',
        'nis' => '2024002',
        'has_sim' => false,
    ]);

    Livewire::test(DriverIndex::class)
        ->assertSeeHtml([
            '<div class="text-3xl font-bold text-white">2</div>',
            '<div class="text-3xl font-bold text-white">1</div>',
        ])
        ->call('delete', $hasSim->id)
        ->assertDontSee('Student with SIM')
        ->assertSeeHtml([
            '<div class="text-3xl font-bold text-white">1</div>',
            '<div class="text-3xl font-bold text-white">0</div>',
        ]);

    $this->assertDatabaseMissing('sim_records', ['id' => $hasSim->id]);
});

test('the sample SIM roster can be seeded without overwriting existing records', function () {
    SimRecord::create([
        'name' => 'Updated student',
        'nis' => '2024001',
        'has_sim' => false,
    ]);

    $this->seed(SimRecordSeeder::class);

    $this->assertDatabaseCount('sim_records', 6);
    $this->assertDatabaseHas('sim_records', [
        'name' => 'Updated student',
        'nis' => '2024001',
        'has_sim' => false,
    ]);
});
