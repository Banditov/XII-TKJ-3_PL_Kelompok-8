<?php

namespace Database\Seeders;

use App\Data\EquipmentData;
use App\Models\Equipment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentSeeder extends Seeder
{
    public function run(): void
    {
        $classId = DB::table('classes')->where('name', 'XII TKJ 3')->value('id');

        if (! $classId) {
            $classId = DB::table('classes')->insertGetId([
                'name' => 'XII TKJ 3',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        foreach (EquipmentData::all() as $item) {
            Equipment::updateOrCreate(
                [
                    'class_id' => $classId,
                    'name' => $item['name'],
                ],
                [
                    'total' => $item['total'],
                    'description' => $item['description'],
                ]
            );
        }
    }
}