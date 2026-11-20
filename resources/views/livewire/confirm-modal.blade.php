<div>
    @if ($show)
        <div class="fixed inset-0 z-[9999] flex items-center justify-center p-4 bg-slate-950/80 backdrop-blur-sm transition-opacity">

            <div class="glass bg-black/40 border border-white/10 rounded-3xl shadow-2xl shadow-black/60 w-full max-w-md p-6 sm:p-8 text-center transform transition-all scale-100 4xs:zoom-60 3xs:zoom-70 2xs:zoom-75 xs:zoom-80 sm:zoom-90 md:zoom-100">
                
                {{-- Warning Icon --}}
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-500/10 border border-red-400/20 mb-6">
                    {!! icon('important', 'h-8 w-8 text-red-400') !!}
                </div>

                {{-- Title & Message --}}
                <h3 class="text-2xl font-bold text-white mb-2">{{ $title }}</h3>
                <p class="text-white/60 mb-8">{{ $message }}</p>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    <button wire:click="cancel" type="button"
                        class="flex-1 rounded-xl border border-white/20 bg-white/5 px-6 py-3 text-white font-semibold transition-all duration-300 hover:bg-white/10 hover:scale-[1.02] active:scale-95">
                        {{ $cancelText }}
                    </button>

                    <button wire:click="confirm" type="button"
                        class="flex-1 relative bg-linear-to-r from-[#ed4a4a] to-[#d43a3a] hover:from-[#d43a3a] hover:to-[#b42a2a] transition-all duration-300 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-red-500/30 hover:shadow-red-500/50 hover:scale-[1.02] active:scale-95">
                        {{ $confirmText }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>