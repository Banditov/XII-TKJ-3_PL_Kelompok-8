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
                <div class="text-3xl font-bold text-white">{{ $totalStudents }}</div>
                <p class="mt-3 hidden md:block text-lg font-medium text-white/60">Total Siswa</p>
            </div>
        </div>

        {{-- Memiliki SIM --}}
        <div class="rounded-[18px] border flex gap-5 items-center border-green-400/20 bg-white/5 p-4 shadow-xl shadow-black/20 backdrop-blur-sm transition-all duration-300 hover:bg-white/10">
            <div class="flex h-20 w-20 items-center justify-center rounded-full border border-green-400/20 bg-green-500/10 text-green-300/70">
                {!! icon('havesim', 'h-15 w-15') !!}
            </div>
            <div class="flex flex-col">
                <div class="text-3xl font-bold text-white">{{ $hasSimCount }}</div>
                <p class="mt-3 hidden md:block text-lg font-medium text-white/60">Memiliki SIM</p>
            </div>
        </div>

        {{-- Tidak Memiliki SIM --}}
        <div class="rounded-[18px] border flex gap-5 items-center border-red-400/20 bg-white/5 p-4 shadow-xl shadow-black/20 backdrop-blur-sm transition-all duration-300 hover:bg-white/10">
            <div class="flex h-20 w-20 items-center justify-center rounded-full border border-red-400/20 bg-red-500/10 text-red-300/70">
                {!! icon('nosim', 'h-15 w-15') !!}
            </div>
            <div class="flex flex-col">
                <div class="text-3xl font-bold text-white">{{ $noSimCount }}</div>
                <p class="mt-3 hidden md:block text-lg font-medium text-white/60">Tidak Memiliki SIM</p>
            </div>
        </div>
    </div>

    {{-- Daftar Penggunaan SIM --}}
    <section>
        <h2 class="mb-4 text-3xl font-bold text-white">Daftar Penggunaan SIM Siswa</h2>
        <div class="mb-5 border-b border-white/10"></div>

        <div class="mb-5 flex justify-end">
            <button type="button" wire:click="create"
                class="rounded-[14px] bg-linear-to-r from-blue-500 to-sky-300 px-4 py-2.5 text-lg font-semibold text-white shadow-lg shadow-black/20 transition-all duration-300 hover:scale-[1.02] active:scale-95">
                Tambah siswa
            </button>
        </div>

        @if ($showForm)
            <form wire:submit="save" class="mb-6 space-y-4 rounded-2xl border border-white/10 bg-white/5 p-5 text-white">
                <h3 class="text-xl font-semibold">{{ $editingId ? 'Ubah data SIM siswa' : 'Tambah data SIM siswa' }}</h3>

                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="block">
                        <span class="mb-1 block text-sm text-white/70">Nama siswa</span>
                        <input type="text" wire:model="name" maxlength="255"
                            class="w-full rounded-xl border border-white/15 bg-black/20 px-4 py-3 text-white">
                        @error('name') <span class="mt-1 block text-sm text-red-300">{{ $message }}</span> @enderror
                    </label>

                    <label class="block">
                        <span class="mb-1 block text-sm text-white/70">NIS</span>
                        <input type="text" wire:model="nis" maxlength="255"
                            class="w-full rounded-xl border border-white/15 bg-black/20 px-4 py-3 text-white">
                        @error('nis') <span class="mt-1 block text-sm text-red-300">{{ $message }}</span> @enderror
                    </label>
                </div>

                <label class="flex items-center gap-3 text-white/80">
                    <input type="checkbox" wire:model="hasSim" class="rounded border-white/20 bg-black/20">
                    Memiliki SIM
                </label>

                <div class="flex gap-3">
                    <button type="submit"
                        class="rounded-xl bg-blue-500 px-4 py-2 font-semibold text-white hover:bg-blue-400">
                        Simpan
                    </button>
                    <button type="button" wire:click="cancel"
                        class="rounded-xl border border-white/20 px-4 py-2 font-semibold text-white/70 hover:bg-white/10">
                        Batal
                    </button>
                </div>
            </form>
        @endif

        {{-- Daftar Siswa --}}
        <div class="space-y-4">
            @forelse ($students as $student)
                <div class="flex items-center justify-between gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 text-white transition-all duration-300 hover:bg-white/10">
                    <p class="text-xl font-semibold">{{ $student->name }} &mdash; {{ $student->nis }}</p>

                    <div class="flex items-center gap-3">
                        @if ($student->has_sim)
                            <span class="rounded-[14px] border border-green-400/20 bg-green-500/10 px-4 py-2 text-sm font-semibold text-green-300/70">
                                Memiliki SIM
                            </span>
                        @else
                            <span class="rounded-[14px] border border-red-400/20 bg-red-500/10 px-4 py-2 text-sm font-semibold text-red-300/70">
                                Tidak Memiliki SIM
                            </span>
                        @endif
                        <button type="button" wire:click="edit({{ $student->id }})"
                            class="flex h-10 w-10 items-center justify-center rounded-full border border-yellow-400/20 bg-yellow-500/10 text-yellow-300/70 transition-all duration-300 hover:bg-yellow-500/20"
                            aria-label="Ubah {{ $student->name }}">
                            {!! icon('pencil', 'h-5 w-5') !!}
                        </button>
                        <button type="button" wire:click="delete({{ $student->id }})"
                            wire:confirm="Yakin ingin menghapus data SIM {{ $student->name }}?"
                            class="flex h-10 w-10 items-center justify-center rounded-full border border-red-400/20 bg-red-500/10 text-red-300/70 transition-all duration-300 hover:bg-red-500/20"
                            aria-label="Hapus {{ $student->name }}">
                            {!! icon('delete', 'h-5 w-5') !!}
                        </button>
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