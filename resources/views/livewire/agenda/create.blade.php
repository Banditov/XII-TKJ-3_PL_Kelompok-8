<section class="flex flex-col h-full">
    <!-- Header -->
    <header class="mb-8 flex items-center justify-between">
        <div class="flex flex-col gap-2 text-white">
            <h1 class="text-5xl font-bold">Tambahkan Agenda</h1>
            <p class="font-semibold text-white/60">Isi informasi agenda yang ingin ditambahkan.</p>
        </div>
    </header>

    <!-- Success/Error Messages -->
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
        <!-- Title -->
        <div class="flex flex-col gap-5">
            <label for="title" class="text-2xl font-bold text-white">
                Judul Agenda <span class="text-red-400">*</span>
            </label>
            <input type="text" id="title" wire:model.live="title" autofocus
                class="zoom-120 w-full p-4 bg-white/5 backdrop-blur-sm border border-white/15 rounded-xl text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400/30 focus:border-blue-400/30 transition-all duration-300 hover:bg-white/10"
                placeholder="Contoh: Ujian, rapat kelas, ...">
            @error('title')
                <p class="text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div class="flex flex-col gap-5 h-full">
            <label for="description" class="text-2xl font-bold text-white">
                Deskripsi
            </label>
            <textarea id="description" wire:model.live="description"
                class="zoom-120 w-full h-full p-4 bg-white/5 backdrop-blur-sm border border-white/15 rounded-xl text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400/30 focus:border-blue-400/30 transition-all duration-300 hover:bg-white/10"
                placeholder="Contoh: Ujian, rapat kelas, ..."></textarea>
            @error('description')
                <p class="text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Date & Time -->
        <div class="flex flex-col sm:flex-row gap-6 sm:gap-8">
            <!-- Time -->
            <div class="flex-1">
                <p class="text-2xl font-bold text-white mb-5">Waktu <span class="text-red-400">*</span></p>
                <input type="time" id="time" wire:model.live="time"
                    class="zoom-120 w-full p-4 bg-white/5 backdrop-blur-sm border border-white/15 rounded-xl text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400/30 focus:border-blue-400/30 transition-all duration-300 hover:bg-white/10">
                @error('time')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date -->
            <div class="flex-1">
                <p class="text-2xl font-bold text-white mb-5">Tanggal <span class="text-red-400">*</span></p>
                <input type="date" id="date" wire:model.live="date" min="{{ now()->format('Y-m-d') }}"
                    class="zoom-120 w-full p-4 bg-white/5 backdrop-blur-sm border border-white/15 rounded-xl text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400/30 focus:border-blue-400/30 transition-all duration-300 hover:bg-white/10">
                @error('date')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row gap-8 mt-4">
            <a href="{{ route('agenda') }}" wire:navigate
                class="relative bg-linear-to-r from-[#ed4a4a] to-[#d43a3a] hover:from-[#d43a3a] hover:to-[#b42a2a] transition-all duration-300 text-white font-bold py-4 px-4 rounded-xl text-lg shadow-lg shadow-red-500/30 hover:shadow-red-500/50 hover:scale-[1.02] active:scale-95 overflow-hidden group w-full sm:w-1/2 text-center">
                <span class="relative z-10 flex items-center justify-center gap-2">
                    Batal
                </span>
                <div
                    class="absolute inset-0 bg-white/20 -translate-x-full group-hover:translate-x-full transition-transform duration-700 skew-x-12">
                </div>
            </a>

            <button type="submit" wire:loading.attr="disabled"
                class="relative bg-linear-to-r from-[#4AA9ED] to-[#3a8fd4] hover:from-[#3a8fd4] hover:to-[#2a7fb4] transition-all duration-300 text-white font-bold py-4 px-4 rounded-xl text-lg shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:scale-[1.02] active:scale-95 overflow-hidden group disabled:opacity-70 disabled:cursor-not-allowed w-full sm:w-1/2">
                <span class="relative z-10 flex items-center justify-center gap-2">
                    Simpan
                </span>
                <div
                    class="absolute inset-0 bg-white/20 -translate-x-full group-hover:translate-x-full transition-transform duration-700 skew-x-12">
                </div>
            </button>
        </div>
    </form>
</section>