<?php
namespace App\Data;

class AbsentData
{
    public static function students(): array
    {
        return [
            [
                'nama' => 'Christopher Vittorio C.',
                'nis' => '2024001',
                'status' => 'hadir',
                'reason' => null,
            ],
            [
                'nama' => 'Michelle Nathaliu',
                'nis' => '2024002',
                'status' => 'izin',
                'reason' => 'Sakit',
            ],
            [
                'nama' => 'Valentino',
                'nis' => '2024003',
                'status' => 'belum',
                'reason' => null,
            ],
            [
                'nama' => 'Andreas Wijaya',
                'nis' => '2024004',
                'status' => 'hadir',
                'reason' => null,
            ],
            [
                'nama' => 'Bella Kusuma',
                'nis' => '2024005',
                'status' => 'izin',
                'reason' => 'Acara keluarga',
            ],
            [
                'nama' => 'Cindy Halim',
                'nis' => '2024006',
                'status' => 'belum',
                'reason' => null,
            ],
        ];
    }

    public static function totalStudents(): int
    {
        return count(self::students());
    }

    public static function attendedCount(): int
    {
        return collect(self::students())
            ->whereIn('status', ['hadir', 'izin'])
            ->count();
    }

    public static function notAttendedCount(): int
    {
        return collect(self::students())
            ->where('status', 'belum')
            ->count();
    }

    public static function find(string $nis): ?array
    {
        foreach (self::students() as $student) {
            if ($student['nis'] === $nis) {
                return $student;
            }
        }
        return null;
    }
}