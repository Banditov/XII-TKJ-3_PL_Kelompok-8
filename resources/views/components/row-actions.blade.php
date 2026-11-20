@props([
    'editRoute' => null, 
    'deleteId' => null, 
    'deleteName' => null
])

<div class="flex items-center gap-3">
    @if ($editRoute)
        <a href="{{ $editRoute }}" wire:navigate
            class="flex h-10 w-10 items-center justify-center rounded-full border border-yellow-400/20 bg-yellow-500/10 text-yellow-300/50 transition-all duration-300 hover:bg-yellow-500/20 hover:text-yellow-300/80"
            aria-label="Ubah">
            {!! icon('pencil', 'h-5 w-5') !!}
        </a>
    @endif

    @if ($deleteId)
        <button type="button" wire:click="delete({{ $deleteId }})"
            wire:confirm="Yakin ingin menghapus {{ $deleteName }}?"
            class="flex h-10 w-10 items-center justify-center rounded-full border border-red-400/20 bg-red-500/10 text-red-300/50 transition-all duration-300 hover:bg-red-500/20 hover:text-red-300/80"
            aria-label="Hapus">
            {!! icon('delete', 'h-5 w-5') !!}
        </button>
    @endif
</div>