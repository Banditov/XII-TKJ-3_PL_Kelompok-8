<?php
// database/seeders/ClassSeeder.php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            'X TKJ 1', 'X TKJ 2',
            'X AKL 1',
            'X BiD 1',

            'XI TKJ 1', 'XI TKJ 2',
            'XI AKL 1',
            'XI BiD 1',

            'XII TKJ 1', 'XII TKJ 2', 'XII TKJ 3',
            'XII AKL 1',
            'XII BiD 1',
        ];

        foreach ($classes as $name) {
            SchoolClass::updateOrCreate(['name' => $name]);
        }
    }
}