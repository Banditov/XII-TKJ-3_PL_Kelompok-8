<?php
namespace App\Data;

class StudentData
{
    public static function all(): array
    {
        return [
            [
                'name' => 'Christopher Vittorio C.',
                'nis' => '2024001',
                'status' => 'hadir',
                'reason' => null,
                'hasSim' => true,
            ],
            [
                'name' => 'Michelle Nathaliu',
                'nis' => '2024002',
                'status' => 'izin',
                'reason' => 'Sakit',
                'hasSim' => false,
            ],
            [
                'name' => 'Valentino',
                'nis' => '2024003',
                'status' => 'belum',
                'reason' => null,
                'hasSim' => true,
            ],
            [
                'name' => 'Andreas Wijaya',
                'nis' => '2024004',
                'status' => 'hadir',
                'reason' => null,
                'hasSim' => false,
            ],
            [
                'name' => 'Bella Kusuma',
                'nis' => '2024005',
                'status' => 'izin',
                'reason' => 'Acara keluarga',
                'hasSim' => true,
            ],
            [
                'name' => 'Cindy Halim',
                'nis' => '2024006',
                'status' => 'belum',
                'reason' => null,
                'hasSim' => false,
            ],
        ];
    }

    // === Absensi helpers ===

    public static function attendedCount(): int
    {
        return collect(self::all())->whereIn('status', ['hadir', 'izin'])->count();
    }

    public static function notAttendedCount(): int
    {
        return collect(self::all())->where('status', 'belum')->count();
    }

    // === SIM helpers ===

    public static function hasSimCount(): int
    {
        return collect(self::all())->where('hasSim', true)->count();
    }

    public static function noSimCount(): int
    {
        return collect(self::all())->where('hasSim', false)->count();
    }

    // === Common helpers ===

    public static function total(): int
    {
        return count(self::all());
    }

    public static function find(string $nis): ?array
    {
        foreach (self::all() as $student) {
            if ($student['nis'] === $nis) {
                return $student;
            }
        }
        return null;
    }
}