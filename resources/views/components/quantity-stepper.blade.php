@props(['total'])

<div class="flex items-center gap-4 w-full p-2 bg-white/5 backdrop-blur-sm border border-white/15 rounded-xl">
    <button type="button" wire:click="decrement"
        class="flex h-15 w-15 text-3xl aspect-square items-center justify-center rounded-full border border-red-400/20 bg-red-500/10 text-red-300/50 transition-all duration-300 hover:bg-red-500/20 hover:text-red-300/80"
        aria-label="Kurangi">-</button>

    <input 
        type="number" 
        id="total" 
        wire:model="{{ $total }}" 
        min="1"
        class="w-full bg-transparent text-center text-2xl font-bold text-white focus:outline-none"
    >

    <button type="button" wire:click="increment"
        class="flex h-15 w-15 text-3xl aspect-square items-center justify-center rounded-full border border-lime-400/20 bg-lime-500/10 text-lime-300/50 transition-all duration-300 hover:bg-lime-500/20 hover:text-lime-300/80"
        aria-label="Tambah">+</button>
</div>