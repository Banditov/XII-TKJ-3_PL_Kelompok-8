<?php
namespace App\Data;

use Carbon\Carbon;

class AgendaData
{
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Ujian Matematika',
                'description' => 'Ujian bab trigonometri, bawa kalkulator.',
                'date' => now()->format('Y-m-d'),
                'time' => '08:00',
            ],
            [
                'id' => 2,
                'title' => 'Rapat Kelas',
                'description' => 'Membahas persiapan study tour.',
                'date' => now()->format('Y-m-d'),
                'time' => '10:00',
            ],
            [
                'id' => 3,
                'title' => 'Kumpul Tugas Bahasa Indonesia',
                'description' => 'Tugas esai tentang lingkungan.',
                'date' => now()->format('Y-m-d'),
                'time' => '13:00',
            ],
            [
                'id' => 4,
                'title' => 'Ujian Fisika',
                'description' => 'Ujian bab gerak parabola.',
                'date' => now()->addDays(2)->format('Y-m-d'),
                'time' => '08:00',
            ],
            [
                'id' => 5,
                'title' => 'Kumpul Laporan Praktikum',
                'description' => 'Laporan praktikum kimia bab titrasi.',
                'date' => now()->subDays(1)->format('Y-m-d'),
                'time' => '15:00',
            ],
            [
                'id' => 6,
                'title' => 'Presentasi Sejarah',
                'description' => 'Presentasi kelompok tentang kemerdekaan.',
                'date' => now()->subDays(3)->format('Y-m-d'),
                'time' => '09:00',
            ],
            [
                'id' => 7,
                'title' => 'Study Tour',
                'description' => 'Kunjungan ke museum nasional.',
                'date' => now()->addDays(7)->format('Y-m-d'),
                'time' => '07:00',
            ],
        ];
    }

    public static function now(): array
    {
        return array_values(
            array_filter(self::all(), function ($item) {
                return Carbon::parse($item['date'])->isToday();
            })
        );
    }

    public static function late(): array
    {
        return array_values(
            array_filter(self::all(), function ($item) {
                return Carbon::parse($item['date'])->isPast()
                    && !Carbon::parse($item['date'])->isToday();
            })
        );
    }

    public static function upcoming(): array
    {
        return array_values(
            array_filter(self::all(), function ($item) {
                return Carbon::parse($item['date'])->isFuture();
            })
        );
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

    public static function today(): array
    {
        return array_values(
            array_filter(self::all(), function ($item) {
                return Carbon::parse($item['date'])->isToday();
            })
        );
    }
}