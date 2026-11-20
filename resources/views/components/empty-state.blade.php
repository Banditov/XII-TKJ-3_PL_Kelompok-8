@props(['message' => 'Belum ada data.', 'icon' => 'task'])

<div class="rounded-2xl border border-white/10 bg-white/5 p-12 text-center flex flex-col items-center gap-4 w-full text-white/40">
    {!! icon($icon, 'h-12 w-12') !!}
    <p class="text-xl font-semibold">{{ $message }}</p>
</div>