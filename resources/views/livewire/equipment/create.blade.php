<section class="flex flex-col h-full">
    <!-- Header -->
    <header class="mb-8 flex items-center justify-between">
        <div class="flex flex-col gap-2 text-white">
            <h1 class="text-5xl font-bold">Tambahkan Perlengkapan Baru</h1>
            <p class="font-semibold text-white/60">{{ $kelas ?? 'XII TKJ 3' }}</p>
        </div>
    </header>

    @if (session()->has('success'))
        <div class="mb-6 rounded-xl border border-emerald-400/20 bg-emerald-500/10 p-4 text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-6 rounded-xl border border-red-400/20 bg-red-500/10 p-4 text-red-300">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit="save" class="flex flex-col h-full gap-8 justify-between">
        <!-- Informasi Dasar -->
        <div class="flex flex-col gap-5">
            <div>
                <h2 class="text-2xl font-bold text-white">Informasi Dasar</h2>
                <div class="mt-3 border-b border-white/15"></div>
            </div>

            <label for="name" class="text-lg font-semibold text-white/80">
                Nama Perlengkapan <span class="text-red-400">*</span>
            </label>
            <input type="text" id="name" wire:model.live="name" autofocus
                class="zoom-120 w-full p-4 bg-white/5 backdrop-blur-sm border border-white/15 rounded-xl text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400/30 focus:border-blue-400/30 transition-all duration-300 hover:bg-white/10"
                placeholder="Contoh: Papan Tulis">
            @error('name')
                <p class="text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status & Jumlah -->
        <div class="flex flex-col gap-5">
            <div>
                <h2 class="text-2xl font-bold text-white">Status & Jumlah</h2>
                <div class="mt-3 border-b border-white/15"></div>
            </div>

            <label class="text-lg font-semibold text-white/80">
                Jumlah Total <span class="text-red-400">*</span>
            </label>
            <div class="flex items-center gap-4 w-full p-2 bg-white/5 backdrop-blur-sm border border-white/15 rounded-xl">
                <button type="button" wire:click="decrement"
                    class="flex h-15 w-15 text-3xl aspect-square items-center justify-center rounded-full border border-red-400/20 bg-red-500/10 text-red-300/50 transition-all duration-300 hover:bg-red-500/20 hover:text-red-300/80"
                    aria-label="Kurangi">-</button>

                <input type="number" id="total" wire:model.live="total" min="1"
                    class="w-full bg-transparent text-center text-2xl font-bold text-white focus:outline-none">

                <button type="button" wire:click="increment"
                    class="flex h-15 w-15 text-3xl aspect-square items-center justify-center rounded-full border border-lime-400/20 bg-lime-500/10 text-lime-300/50 transition-all duration-300 hover:bg-lime-500/20 hover:text-lime-300/80"
                    aria-label="Tambah">+</button>
            </div>
            @error('total')
                <p class="text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Catatan -->
        <div class="flex flex-col gap-5 h-full">
            <div>
                <h2 class="text-2xl font-bold text-white">Catatan</h2>
                <div class="mt-3 border-b border-white/15"></div>
            </div>

            <label for="description" class="text-lg font-semibold text-white/80">
                Catatan Tambahan
            </label>
            <textarea id="description" wire:model.live="description"
                class="zoom-120 w-full h-full p-4 bg-white/5 backdrop-blur-sm border border-white/15 rounded-xl text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400/30 focus:border-blue-400/30 transition-all duration-300 hover:bg-white/10"
                placeholder="Isi catatan tambahan..."></textarea>
            @error('description')
                <p class="text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row gap-8 mt-4">
            <a href="{{ route('equipment') }}"
                class="relative bg-linear-to-r from-[#ed4a4a] to-[#d43a3a] hover:from-[#d43a3a] hover:to-[#b42a2a] transition-all duration-300 text-white font-bold py-4 px-4 rounded-xl text-lg shadow-lg shadow-red-500/30 hover:shadow-red-500/50 hover:scale-[1.02] active:scale-95 overflow-hidden group w-full sm:w-1/2 text-center">
                <span class="relative z-10 flex items-center justify-center gap-2">Batal</span>
                <div class="absolute inset-0 bg-white/20 -translate-x-full group-hover:translate-x-full transition-transform duration-700 skew-x-12"></div>
            </a>

            <button type="submit" wire:loading.attr="disabled" wire:target="save"
                class="relative bg-linear-to-r from-[#4AA9ED] to-[#3a8fd4] hover:from-[#3a8fd4] hover:to-[#2a7fb4] transition-all duration-300 text-white font-bold py-4 px-4 rounded-xl text-lg shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:scale-[1.02] active:scale-95 overflow-hidden group disabled:opacity-70 disabled:cursor-not-allowed w-full sm:w-1/2">
                <span class="relative z-10 flex items-center justify-center gap-2">
                    <span wire:loading.remove wire:target="save">Simpan</span>
                    <span wire:loading wire:target="save">Menyimpan...</span>
                </span>
                <div class="absolute inset-0 bg-white/20 -translate-x-full group-hover:translate-x-full transition-transform duration-700 skew-x-12"></div>
            </button>
        </div>
    </form>
</section>