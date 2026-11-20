@props(['status'])

@php
    $classes = match($status) {
        'hadir' => 'border-green-400/20 bg-green-500/10 text-green-300/70',
        'izin'  => 'border-yellow-400/20 bg-yellow-500/10 text-yellow-300/70',
        'sakit' => 'border-blue-400/20 bg-blue-500/10 text-blue-300/70',
        'alpha' => 'border-red-400/20 bg-red-500/10 text-red-300/70',
        default => 'border-white/20 bg-white/10 text-white/50',
    };
@endphp

<span class="rounded-[14px] border text-center px-4 py-2 text-sm font-semibold {{ $classes }}">
    {{ match($status) {
        'hadir' => 'Sudah Absen',
        'izin'  => 'Izin',
        'sakit' => 'Sakit',
        'alpha' => 'Alpha',
        default => 'Belum Absen',
    } }}
</span>