<section>
    {{-- Header --}}
    <header class="mb-8 flex items-center justify-between">
        <div class="flex flex-col gap-2 text-white">
            <h1 class="text-5xl font-bold">Penggunaan SIM</h1>
            <p class="font-semibold">XII TKJ 3</p>
        </div>
    </header>

    {{-- Success Message --}}
    @if (session()->has('success'))
        <div class="mb-6 rounded-xl border border-emerald-400/20 bg-emerald-500/10 p-4 text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Stats Cards --}}
    <div class="mb-7 grid grid-cols-3 gap-5 4xs:zoom-60 xs:zoom-70 sm:zoom-80 md:zoom-90 lg:zoom-100 xl:zoom-110 2xl:zoom-120">
        {{-- Total Siswa --}}
        <div class="rounded-[18px] border flex gap-5 items-center border-blue-400/20 bg-white/5 p-4 shadow-xl shadow-black/20 backdrop-blur-sm transition-all duration-300 hover:bg-white/10">
            <div class="flex h-20 w-20 items-center justify-center rounded-full border border-blue-400/20 bg-blue-500/10 text-blue-300/70">
                {!! icon('people', 'h-10 w-10') !!}
            </div>
            <div class="flex flex-col">
                <div class="text-3xl font-bold text-white">{{ $this->totalStudents }}</div>
                <p class="mt-3 hidden md:block text-lg font-medium text-white/60">Total Siswa</p>
            </div>
        </div>

        {{-- Memiliki SIM --}}
        <div class="rounded-[18px] border flex gap-5 items-center border-green-400/20 bg-white/5 p-4 shadow-xl shadow-black/20 backdrop-blur-sm transition-all duration-300 hover:bg-white/10">
            <div class="flex h-20 w-20 items-center justify-center rounded-full border border-green-400/20 bg-green-500/10 text-green-300/70">
                {!! icon('havesim', 'h-15 w-15') !!}
            </div>
            <div class="flex flex-col">
                <div class="text-3xl font-bold text-white">{{ $this->hasSim }}</div>
                <p class="mt-3 hidden md:block text-lg font-medium text-white/60">Memiliki SIM</p>
            </div>
        </div>

        {{-- Tidak Memiliki SIM --}}
        <div class="rounded-[18px] border flex gap-5 items-center border-red-400/20 bg-white/5 p-4 shadow-xl shadow-black/20 backdrop-blur-sm transition-all duration-300 hover:bg-white/10">
            <div class="flex h-20 w-20 items-center justify-center rounded-full border border-red-400/20 bg-red-500/10 text-red-300/70">
                {!! icon('nosim', 'h-15 w-15') !!}
            </div>
            <div class="flex flex-col">
                <div class="text-3xl font-bold text-white">{{ $this->noSim }}</div>
                <p class="mt-3 hidden md:block text-lg font-medium text-white/60">Tidak Memiliki SIM</p>
            </div>
        </div>
    </div>

    {{-- Daftar Penggunaan SIM --}}
    <section>
        <h2 class="mb-4 text-3xl font-bold text-white">Daftar Penggunaan SIM Siswa</h2>
        <div class="mb-5 border-b border-white/10"></div>

        {{-- User Sekarang --}}
        <div class="flex items-center justify-between gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 text-white transition-all duration-300 hover:bg-white/10">
            <p class="text-xl font-semibold">User sekarang</p>

            <div class="flex items-center gap-3">
                <button type="button"
                    class="flex h-10 w-10 items-center justify-center rounded-full border border-white/20 bg-white/10 text-white/50 transition-all duration-300 hover:bg-white/20 hover:text-white/80"
                    aria-label="Lihat">
                    {!! icon('eye', 'h-5 w-5') !!}
                </button>
                <button type="button"
                    class="flex h-10 w-10 items-center justify-center rounded-full border border-yellow-400/20 bg-yellow-500/10 text-yellow-300/50 transition-all duration-300 hover:bg-yellow-500/20 hover:text-yellow-300/80"
                    aria-label="Ubah">
                    {!! icon('pencil', 'h-5 w-5') !!}
                </button>
                <button type="button"
                    class="flex h-10 w-10 items-center justify-center rounded-full border border-red-400/20 bg-red-500/10 text-red-300/50 transition-all duration-300 hover:bg-red-500/20 hover:text-red-300/80"
                    aria-label="Hapus">
                    {!! icon('delete', 'h-5 w-5') !!}
                </button>
            </div>
        </div>

        <div class="my-5 border-b border-white/10"></div>

        {{-- Daftar Siswa --}}
        <div class="space-y-4">
            @forelse ($students as $student)
                <div class="flex items-center justify-between gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 text-white transition-all duration-300 hover:bg-white/10">
                    <p class="text-xl font-semibold">{{ $student['name'] }} &mdash; {{ $student['nis'] }}</p>

                    <div class="flex items-center gap-3">
                        @if ($student['hasSim'])
                            <span class="rounded-[14px] border border-green-400/20 bg-green-500/10 px-4 py-2 text-sm font-semibold text-green-300/70">
                                Memiliki SIM
                            </span>
                        @else
                            <span class="rounded-[14px] border border-red-400/20 bg-red-500/10 px-4 py-2 text-sm font-semibold text-red-300/70">
                                Tidak Memiliki SIM
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="rounded-2xl border border-white/10 bg-white/5 p-12 text-center">
                    <p class="text-white/60">Belum ada data siswa.</p>
                </div>
            @endforelse
        </div>
    </section>
</section>