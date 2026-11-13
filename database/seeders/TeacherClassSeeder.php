<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherClassSeeder extends Seeder
{
    public function run(): void
    {
        $teacher = Teacher::where('email', 'admin@ski.sch.id')->first();
        if (! $teacher) {
            return;
        }

        $classIds = SchoolClass::whereIn('name', ['XII TKJ 3', 'XII TKJ 1'])->pluck('id')->all();
        $teacher->schoolClasses()->syncWithoutDetaching($classIds);
    }
}