<?php

namespace Database\Seeders;

use App\Data\StudentData;
use App\Models\SimRecord;
use Illuminate\Database\Seeder;

class SimRecordSeeder extends Seeder
{
    public function run(): void
    {
        foreach (StudentData::all() as $student) {
            SimRecord::firstOrCreate(
                ['nis' => $student['nis']],
                ['name' => $student['name'], 'has_sim' => $student['hasSim']],
            );
        }
    }
}
