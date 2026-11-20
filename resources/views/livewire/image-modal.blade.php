<div>
    @if ($show)
        <div class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-950/90 backdrop-blur-md transition-opacity"
            wire:click.self="close">

            <div class="relative max-w-4xl w-full flex flex-col items-center">

                {{-- Close Button --}}
                <button wire:click="close"
                    class="absolute -top-12 right-0 flex h-10 w-10 items-center justify-center rounded-full border border-white/20 bg-white/10 text-white/70 hover:bg-white/20 hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                {{-- Image --}}
                <img src="{{ $imageUrl }}"
                    class="max-h-[85vh] w-auto rounded-2xl border border-white/20 shadow-2xl shadow-black/50 object-contain"
                    alt="Preview Image">
            </div>
        </div>
    @endif
</div>