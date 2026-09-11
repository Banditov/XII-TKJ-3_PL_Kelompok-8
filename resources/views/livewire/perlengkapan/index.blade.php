<div class="glass 4xs:h-[85%] sm:h-[90%] sm:w-full 4xs:w-auto m-15 p-5 rounded-3xl bg-black/20 backdrop-blur-[5px] border border-white/10 shadow-2xl shadow-black/60 4xs:zoom-70 2xs:zoom-75 xs:zoom-80 sm:zoom-70 md:zoom-75 lg:zoom-80 xl:zoom-85 2xl:zoom-85">
    <header class="mb-8 flex items-center justify-between">
        <div class="flex flex-col gap-1 text-white">
            <h1 class="text-5xl font-bold">Perlengkapan</h1>
            <p class="text-xl font-semibold">XII TKJ 3</p>
        </div>

        <button type="button" class="rounded-[14px] border border-white/20 bg-sky-400/90 px-7 py-3 text-2xl font-semibold text-white shadow-lg shadow-sky-500/30 transition-all duration-300 hover:bg-sky-300">
            Tambah <span class="text-3xl leading-none">+</span>
        </button>
    </header>

    <section>
        <div class="mb-3 flex items-center gap-4">
            <h2 class="text-3xl font-bold text-white">Daftar Perlengkapan</h2>
            <div class="h-0.5 flex-1 bg-white"></div>
        </div>

        <div class="space-y-4">
            @foreach ($equipment as $item)
                <article class="flex min-h-24 items-center justify-between gap-5 rounded-[18px] border border-black/50 bg-[#151619] px-6 py-4 text-white shadow-lg shadow-black/30">
                    <div>
                        <h3 class="text-3xl font-semibold">{{ $item['name'] }}</h3>
                        <p class="text-xl text-white/90">{{ $item['damaged'] > 0 ? $item['damaged'] . ' Rusak' : 'Normal' }}</p>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="button" class="flex h-11 w-11 items-center justify-center rounded-full border border-red-500/40 text-2xl font-bold text-red-500" aria-label="Kurangi">-</button>
                        <span class="flex h-10 w-10 items-center justify-center rounded-md border border-white/10 bg-[#242528] text-2xl font-semibold">{{ $item['total'] }}</span>
                        <button type="button" class="flex h-11 w-11 items-center justify-center rounded-full border border-lime-400/40 text-2xl font-bold text-lime-400" aria-label="Tambah">+</button>
                        <button type="button" class="ml-4 flex h-11 w-11 items-center justify-center rounded-full border border-yellow-400/40 text-yellow-400" aria-label="Ubah">
                            {!! icon('pencil', 'h-6 w-6') !!}
                        </button>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</div>
