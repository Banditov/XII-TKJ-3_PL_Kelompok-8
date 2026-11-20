<section>
    <!-- Header -->
    <header class="mb-8 flex items-center justify-between">
        <div class="flex flex-col gap-2 text-white">
            <h1 class="text-5xl font-bold 4xs:zoom-60 2xs:zoom-70 xs:zoom-80 sm:zoom-100">Absensi Siswa</h1>
            <p class="font-semibold">{{ $this->classLabel }}</p>
        </div>

        <div class="flex items-center gap-3">
            <x-class-selector 
                :classes="$classes ?? []" 
                selected="selectedClassId" 
                :isTeacher="Auth::guard('teacher')->check()" 
            />

            <div x-data="{ open: false }" class="relative flex items-center gap-3">
                <p class="text-lg font-semibold text-white 4xs:hidden sm:block">Pilih Tanggal:</p>
                <button type="button" @click="$refs.datePicker.showPicker(); open = true"
                    class="flex items-center gap-2 rounded-[14px] bg-linear-to-r from-blue-500 to-sky-300 px-4 py-2.5 text-lg font-semibold text-white shadow-lg shadow-black/20 transition-all duration-300 hover:scale-[1.02] active:scale-95">
                    {!! icon('calendar', 'h-5 w-5') !!}
                    <span>{{ \Illuminate\Support\Carbon::parse($selectedDate)->translatedFormat('d-m-Y') }}</span>
                </button>
                <input type="date" x-ref="datePicker" wire:model.live="selectedDate"
                    class="pointer-events-none absolute inset-0 h-full w-full opacity-0">
            </div>
        </div>
    </header>

    <!-- Status Absensi Saya -->
    @if (Auth::guard('student')->check())
        <div class="mb-7 rounded-[18px] border border-white/10 bg-white/5 p-6 shadow-xl shadow-black/20 backdrop-blur-sm">

            <div class="flex items-center justify-between 4xs:flex-col sm:flex-row gap-5">
                <div class="flex items-center gap-5">
                    <div
                        class="flex h-16 w-16 items-center justify-center rounded-full bg-linear-to-r from-blue-500 to-sky-300 text-white/70">
                        {!! icon('time', 'h-8 w-8') !!}
                    </div>
                    <div class="flex flex-col">
                        <h2 class="text-2xl font-bold text-white 4xs:zoom-70 2xs:zoom-80 sm:zoom-90 md:zoom-100">Status
                            Absensi Saya Hari Ini</h2>
                        <p class="text-lg font-medium text-white/50">Status : {{ $this->myStatus }}</p>
                    </div>
                </div>

                @if (!$showPermissionForm)
                    <div class="flex 4xs:flex-row sm:flex-col gap-3 4xs:w-full sm:w-auto justify-between">
                        <button type="button" wire:click="absent"
                            class="rounded-[14px] border w-full border-green-400/20 bg-white/5 px-6 py-2.5 text-lg font-semibold text-green-300/70 shadow-lg shadow-black/20 transition-all duration-300 hover:bg-white/10 hover:scale-[1.02] active:scale-95">
                            Absen Masuk
                        </button>
                        <button type="button" wire:click="openPermissionForm"
                            class="rounded-[14px] border w-full border-yellow-400/20 bg-white/5 px-6 py-2.5 text-lg font-semibold text-yellow-300/70 shadow-lg shadow-black/20 transition-all duration-300 hover:bg-white/10 hover:scale-[1.02] active:scale-95">
                            Pengajuan Izin
                        </button>
                    </div>
                @endif
            </div>

            @if ($showPermissionForm)
                <div class="mt-6 pt-6 border-t border-white/10 space-y-4">
                    <div>
                        <label for="permissionReason" class="block text-sm font-medium text-white/70 mb-2">
                            Alasan Izin <span class="text-red-400">*</span>
                        </label>
                        <textarea id="permissionReason" wire:model="permissionReason" rows="3"
                            class="w-full rounded-xl bg-white/5 backdrop-blur-sm border border-white/15 p-4 text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-yellow-400/30 focus:border-yellow-400/30 transition-all duration-300 hover:bg-white/10 resize-none"
                            placeholder="Contoh: Sakit demam, keperluan keluarga, ..."></textarea>
                        @error('permissionReason')
                            <span class="text-red-400 text-sm mt-1.5 flex items-center gap-1">
                                {!! icon('important', 'w-4 h-4') !!}
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="button" wire:click="permission" wire:loading.attr="disabled" wire:target="permission"
                            class="flex-1 rounded-[14px] bg-linear-to-r from-yellow-500 to-orange-500 px-6 py-3 text-white font-semibold shadow-lg shadow-yellow-500/30 transition-all duration-300 hover:scale-[1.02] hover:shadow-yellow-500/50 active:scale-95 disabled:opacity-70 disabled:cursor-not-allowed">
                            <span wire:loading.remove wire:target="permission">Kirim Pengajuan</span>
                            <span wire:loading wire:target="permission">Mengirim...</span>
                        </button>
                        <button type="button" wire:click="cancelPermission"
                            class="flex-1 rounded-[14px] border border-white/20 bg-white/5 px-6 py-3 text-white font-semibold transition-all duration-300 hover:bg-white/10 hover:scale-[1.02] active:scale-95">
                            Batal
                        </button>
                    </div>
                </div>
            @endif
        </div>
    @endif

    <!-- Stats Cards -->
    <div
        class="mb-7 grid grid-cols-3 gap-5 4xs:zoom-60 xs:zoom-70 sm:zoom-80 md:zoom-90 lg:zoom-100 xl:zoom-110 2xl:zoom-120">
        <div
            class="rounded-[18px] border flex gap-5 items-center border-blue-400/20 bg-white/5 p-4 shadow-xl shadow-black/20 backdrop-blur-sm transition-all duration-300 hover:bg-white/10">
            <div
                class="flex h-20 w-20 items-center justify-center rounded-full border border-blue-400/20 bg-blue-500/10 text-blue-300/70">
                {!! icon('people', 'h-10 w-10') !!}
            </div>
            <div class="flex flex-col">
                <div class="text-3xl font-bold text-white">{{ $this->studentTotal }}</div>
                <p class="mt-3 hidden md:block text-lg font-medium text-white/60">Banyak Siswa</p>
            </div>
        </div>
        <div
            class="rounded-[18px] border flex gap-5 items-center border-green-400/20 bg-white/5 p-4 shadow-xl shadow-black/20 backdrop-blur-sm transition-all duration-300 hover:bg-white/10">
            <div
                class="flex h-20 w-20 items-center justify-center rounded-full border border-green-400/20 bg-green-500/10 text-green-300/70">
                {!! icon('correct', 'h-10 w-10') !!}
            </div>
            <div class="flex flex-col">
                <div class="text-3xl font-bold text-white">{{ $this->absent }}</div>
                <p class="mt-3 hidden md:block text-lg font-medium text-white/60">Sudah Absen</p>
            </div>
        </div>
        <div
            class="rounded-[18px] border flex gap-5 items-center border-red-400/20 bg-white/5 p-4 shadow-xl shadow-black/20 backdrop-blur-sm transition-all duration-300 hover:bg-white/10">
            <div
                class="flex h-20 w-20 items-center justify-center rounded-full border border-red-400/20 bg-red-500/10 text-red-300/70">
                {!! icon('time', 'h-10 w-10') !!}
            </div>
            <div class="flex flex-col">
                <div class="text-3xl font-bold text-white">{{ $this->notAbsent }}</div>
                <p class="mt-3 hidden md:block text-lg font-medium text-white/60">Belum Absen</p>
            </div>
        </div>
    </div>

    <!-- Daftar Absensi Siswa -->
    <div>
        <h2 class="mb-4 text-3xl font-bold text-white">Daftar Absensi Siswa</h2>
        <div class="mb-5 border-b border-white/10"></div>

        <div class="space-y-4">
            @forelse ($students as $student)
                <div
                    class="flex items-center justify-between gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 text-white transition-all duration-300 hover:bg-white/10">
                    <div class="flex flex-col gap-1">
                        <p class="text-xl font-semibold">{{ $student['name'] }} &mdash; {{ $student['class'] }}</p>
                        @if (in_array($student['status'], ['izin', 'sakit']) && $student['reason'])
                            <p class="text-white/50">Alasan: {{ $student['reason'] }}</p>
                        @endif
                    </div>

                    <x-status-badge :status="$student['status']" />
                </div>
            @empty
                <x-empty-state message="Belum ada data siswa." icon="people" />
            @endforelse
        </div>
    </div>
</section>