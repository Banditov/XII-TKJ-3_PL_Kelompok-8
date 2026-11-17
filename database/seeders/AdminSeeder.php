<?php
// database/seeders/AdminSeeder.php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            ['name' => 'Admin', 'email' => 'admin@ski.sch.id', 'password' => 'password123'],
        ];

        foreach ($admins as $data) {
            Teacher::updateOrCreate(
                ['email' => $data['email']],
                $data
            );
        }
    }
}