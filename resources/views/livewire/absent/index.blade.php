<div class="glass 4xs:h-[85%] sm:h-[90%] sm:w-full 4xs:w-auto m-15 p-5 rounded-3xl bg-black/20 backdrop-blur-[5px] border border-white/10 shadow-2xl shadow-black/60 4xs:zoom-70 2xs:zoom-75 xs:zoom-80 sm:zoom-70 md:zoom-75 lg:zoom-80 xl:zoom-85 2xl:zoom-85">
    <header class="mb-8 flex items-center justify-between">
        <div class="flex flex-col gap-2 text-white">
            <h1 class="text-5xl font-bold 4xs:zoom-60 2xs:zoom-70 xs:zoom-80 sm:zoom-100">Perlengkapan</h1>
            <p class="font-semibold">XII TKJ 3</p>
        </div>

        <button type="button" class="flex items-center gap-2 rounded-[14px] bg-linear-to-r from-blue-500 to-sky-300 px-4 py-2.5 text-lg font-semibold text-white shadow-lg shadow-black/20 transition-all duration-300 hover:scale-[1.02] active:scale-95">
            Tambah <span class="text-2xl leading-none">+</span>
        </button>
    </header>

    <section>
        <h2 class="mb-4 text-3xl font-bold text-white">Daftar Perlengkapan</h2>
        <div class="mb-5 border-b border-white/10"></div>

        <div class="space-y-4">
            @foreach ($equipment as $item)
                <article class="flex items-center justify-between gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 text-white transition-all duration-300 hover:bg-white/10">
                    <div class="flex flex-col gap-1">
                        <h3 class="text-xl font-semibold">{{ $item['name'] }}</h3>
                        <p class="text-white/50">{{ $item['damaged'] > 0 ? $item['damaged'] . ' Rusak' : 'Normal' }}</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="button" class="flex h-11 w-11 items-center justify-center rounded-full border border-red-500/40 text-2xl font-bold text-red-500 transition-all duration-300 hover:bg-red-500/10" aria-label="Kurangi">-</button>
                        <span class="flex h-10 w-10 items-center justify-center rounded-md border border-white/10 bg-white/5 text-2xl font-semibold">{{ $item['total'] }}</span>
                        <button type="button" class="flex h-11 w-11 items-center justify-center rounded-full border border-lime-400/40 text-2xl font-bold text-lime-400 transition-all duration-300 hover:bg-lime-400/10" aria-label="Tambah">+</button>
                        <button type="button" class="ml-4 flex h-11 w-11 items-center justify-center rounded-full border border-yellow-400/40 text-yellow-400 transition-all duration-300 hover:bg-yellow-400/10" aria-label="Ubah">
                            {!! icon('pencil', 'h-6 w-6') !!}
                        </button>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</div>