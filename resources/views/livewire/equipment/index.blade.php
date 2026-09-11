<section>
    <!-- Header -->
    <header class="mb-8 flex items-center justify-between">
        <div class="flex flex-col gap-2 text-white">
            <h1 class="text-5xl font-bold">Perlengkapan</h1>
            <p class="font-semibold">XII TKJ 3</p>
        </div>

        <a href="{{ route('equipment.create') }}" wire:navigate
            class="flex items-center gap-2 rounded-[14px] bg-linear-to-r from-blue-500 to-sky-300 px-4 py-2.5 text-lg font-semibold text-white shadow-lg shadow-black/20 transition-all duration-300 hover:scale-[1.02] active:scale-95">
            <p class="4xs:hidden sm:block">Tambah</p>
            <p class="text-2xl leading-none">+</p>
        </a>
    </header>

    @if (session()->has('success'))
        <div class="mb-6 rounded-xl border border-emerald-400/20 bg-emerald-500/10 p-4 text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    <!-- Daftar Perlengkapan -->
    <section>
        <h2 class="mb-4 text-3xl font-bold text-white">Daftar Perlengkapan</h2>
        <div class="mb-5 border-b border-white/10"></div>

        <div class="space-y-4">
            @forelse ($equipment as $item)
                <article class="flex items-center justify-between gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 text-white transition-all duration-300 hover:bg-white/10">
                    <div class="flex flex-col gap-1">
                        <h3 class="text-2xl font-semibold">{{ $item['name'] }}</h3>
                        <p class="text-white/50">{{ $item['description'] ?? 'Tidak ada catatan' }}</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="button" wire:click="decrement({{ $item['id'] }})"
                            class="flex h-10 w-10 items-center justify-center rounded-full border border-red-400/20 bg-red-500/10 text-red-300/50 transition-all duration-300 hover:bg-red-500/20 hover:text-red-300/80"
                            aria-label="Kurangi">-</button>

                        <span class="flex h-10 w-10 items-center justify-center rounded-[14px] border border-white/10 bg-white/5 text-2xl font-semibold">
                            {{ $item['total'] }}
                        </span>

                        <button type="button" wire:click="increment({{ $item['id'] }})"
                            class="flex h-10 w-10 items-center justify-center rounded-full border border-lime-400/20 bg-lime-500/10 text-lime-300/50 transition-all duration-300 hover:bg-lime-500/20 hover:text-lime-300/80"
                            aria-label="Tambah">+</button>

                        <a href="{{ route('equipment.edit', $item['id']) }}" wire:navigate
                            class="flex h-10 w-10 items-center justify-center rounded-full border border-yellow-400/20 bg-yellow-500/10 text-yellow-300/50 transition-all duration-300 hover:bg-yellow-500/20 hover:text-yellow-300/80"
                            aria-label="Ubah">
                            {!! icon('pencil', 'h-5 w-5') !!}
                        </a>

                        <button type="button" wire:click="delete({{ $item['id'] }})"
                            wire:confirm="Yakin ingin menghapus {{ $item['name'] }}?"
                            class="flex h-10 w-10 items-center justify-center rounded-full border border-red-400/20 bg-red-500/10 text-red-300/50 transition-all duration-300 hover:bg-red-500/20 hover:text-red-300/80"
                            aria-label="Hapus">
                            {!! icon('delete', 'h-5 w-5') !!}
                        </button>
                    </div>
                </article>
            @empty
                <div class="rounded-2xl border border-white/10 bg-white/5 p-12 text-center">
                    <p class="text-white/60">Belum ada perlengkapan.</p>
                </div>
            @endforelse
        </div>
    </section>
</section>