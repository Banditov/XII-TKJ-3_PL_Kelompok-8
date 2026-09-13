<div class="glass 4xs:h-[85%] sm:h-[90%] sm:w-full 4xs:w-auto m-15 p-5 rounded-3xl bg-black/20 backdrop-blur-[5px] border border-white/10 shadow-2xl shadow-black/60 4xs:zoom-70 2xs:zoom-75 xs:zoom-80 sm:zoom-70 md:zoom-75 lg:zoom-80 xl:zoom-85 2xl:zoom-85">
    <header class="mb-8 flex flex-col gap-3 text-white">
        <h1 class="text-5xl font-bold">Penggunaan SIM</h1>
        <p class="text-3xl font-semibold text-white/90">XII TKJ 3</p>
    </header>

    <section class="mb-8 grid grid-cols-3 gap-5">
        @foreach ($stats as $stat)
            <div class="rounded-[18px] border bg-[#151619] p-4 shadow-lg shadow-black/30 {{
                $stat['color'] === 'blue' ? 'border-blue-400/40' :
                ($stat['color'] === 'green' ? 'border-green-400/40' : 'border-red-400/40')
            }}">
                <div class="flex items-center gap-5">
                    <div class="flex h-14 w-14 items-center justify-center rounded-full border bg-black/20 {{
                        $stat['color'] === 'blue' ? 'border-blue-400/50 text-blue-300' :
                        ($stat['color'] === 'green' ? 'border-green-400/50 text-green-300' : 'border-red-400/50 text-red-300')
                    }}">
                        @if ($stat['icon'] === 'group')
                            {!! icon('group', 'h-8 w-8') !!}
                        @elseif ($stat['icon'] === 'check')
                            {!! icon('correct', 'h-8 w-8') !!}
                        @else
                            {!! icon('x', 'h-8 w-8') !!}
                        @endif
                    </div>

                    <div class="text-white">
                        <p class="text-4xl font-bold leading-none">{{ $stat['value'] }}</p>
                        <p class="mt-2 text-2xl font-medium text-white/80">{{ $stat['label'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </section>

    <section>
        <div class="mb-5 flex items-center gap-4">
            <h2 class="text-4xl font-bold text-white">Daftar Penggunaan SIM Siswa</h2>
            <div class="h-0.5 flex-1 bg-white/80"></div>
        </div>

        <div class="space-y-4">
            <div class="flex items-center justify-between gap-3 rounded-[18px] border border-white/10 bg-[#151619]/90 px-6 py-4 shadow-lg shadow-black/30">
                <div class="flex items-center gap-4">
                    <p class="text-3xl font-bold text-white">ABSEN - NAMA USER - NIS</p>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" class="flex h-12 w-12 items-center justify-center rounded-full border border-white/20 bg-white/5 text-white/80 hover:bg-white/10" aria-label="lihat">
                        {!! icon('eye', 'h-7 w-7') !!}
                    </button>
                    <button type="button" class="flex h-12 w-12 items-center justify-center rounded-full border border-white/20 bg-white/5 text-white/80 hover:bg-white/10" aria-label="ubah">
                        {!! icon('pencil', 'h-7 w-7') !!}
                    </button>
                    <button type="button" class="flex h-12 w-12 items-center justify-center rounded-full border border-white/20 bg-white/5 text-white/80 hover:bg-white/10" aria-label="hapus">
                        {!! icon('delete', 'h-7 w-7') !!}
                    </button>
                </div>
            </div>

            @foreach ($students as $student)
                <div class="flex items-center justify-between gap-6 rounded-[18px] border border-black/50 bg-[#151619] px-6 py-4 shadow-lg shadow-black/30">
                    <p class="text-3xl font-bold text-white">{{ $student['name'] }}</p>

                    @if ($student['hasSim'])
                        <span class="rounded-[12px] border border-green-400/60 bg-green-500/15 px-6 py-3 text-2xl font-bold text-green-300 shadow-md shadow-green-500/10">
                            Memiliki SIM
                        </span>
                    @else
                        <span class="rounded-[12px] border border-red-400/60 bg-red-500/15 px-6 py-3 text-2xl font-bold text-red-300 shadow-md shadow-red-500/10">
                            Tidak Memiliki SIM
                        </span>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
</div>
