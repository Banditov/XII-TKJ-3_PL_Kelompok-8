<?php
namespace App\Data;

class EquipmentData
{
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Proyektor',
                'total' => 1,
                'description' => 'Proyektor utama, simpan di lemari guru.',
            ],
            [
                'id' => 2,
                'name' => 'Sapu',
                'total' => 2,
                'description' => 'Satu sapu rusak, perlu diganti.',
            ],
            [
                'id' => 3,
                'name' => 'Papan Tulis',
                'total' => 1,
                'description' => null,
            ],
            [
                'id' => 4,
                'name' => 'Kursi',
                'total' => 40,
                'description' => '3 kursi rusak di baris belakang.',
            ],
            [
                'id' => 5,
                'name' => 'Meja',
                'total' => 20,
                'description' => null,
            ],
            [
                'id' => 6,
                'name' => 'Penghapus',
                'total' => 5,
                'description' => 'Penghapus sudah tipis, perlu beli baru.',
            ],
        ];
    }

    public static function find(int $id): ?array
    {
        foreach (self::all() as $item) {
            if ($item['id'] === $id) {
                return $item;
            }
        }
        return null;
    }
}