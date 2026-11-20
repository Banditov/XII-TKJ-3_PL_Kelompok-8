<section>
    {{-- Header --}}
    <header class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex flex-col gap-2 text-white">
            <h1 class="text-5xl font-bold">Penggunaan SIM</h1>
            <p class="font-semibold">{{ $this->className }}</p>
        </div>

        <div class="flex items-center gap-4">
            <x-class-selector 
                :classes="$classes ?? []" 
                selected="selectedClassId" 
                :isTeacher="Auth::guard('teacher')->check()" 
            />
        </div>
    </header>

    {{-- Stats Cards --}}
    <div class="mb-7 grid grid-cols-3 gap-5 4xs:zoom-60 xs:zoom-70 sm:zoom-80 md:zoom-90 lg:zoom-100 xl:zoom-110 2xl:zoom-120">
        <div class="rounded-[18px] border flex gap-5 items-center border-blue-400/20 bg-white/5 p-4 shadow-xl shadow-black/20 backdrop-blur-sm transition-all duration-300 hover:bg-white/10">
            <div class="flex h-20 w-20 items-center justify-center rounded-full border border-blue-400/20 bg-blue-500/10 text-blue-300/70">
                {!! icon('people', 'h-10 w-10') !!}
            </div>
            <div class="flex flex-col">
                <div class="text-3xl font-bold text-white">{{ $totalStudents }}</div>
                <p class="mt-3 hidden md:block text-lg font-medium text-white/60">Total Siswa</p>
            </div>
        </div>
        <div class="rounded-[18px] border flex gap-5 items-center border-green-400/20 bg-white/5 p-4 shadow-xl shadow-black/20 backdrop-blur-sm transition-all duration-300 hover:bg-white/10">
            <div class="flex h-20 w-20 items-center justify-center rounded-full border border-green-400/20 bg-green-500/10 text-green-300/70">
                {!! icon('correct', 'h-10 w-10') !!}
            </div>
            <div class="flex flex-col">
                <div class="text-3xl font-bold text-white">{{ $hasSimCount }}</div>
                <p class="mt-3 hidden md:block text-lg font-medium text-white/60">Memiliki SIM</p>
            </div>
        </div>
        <div class="rounded-[18px] border flex gap-5 items-center border-red-400/20 bg-white/5 p-4 shadow-xl shadow-black/20 backdrop-blur-sm transition-all duration-300 hover:bg-white/10">
            <div class="flex h-20 w-20 items-center justify-center rounded-full border border-red-400/20 bg-red-500/10 text-red-300/70">
                {!! icon('x', 'h-10 w-10') !!}
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

        {{-- My Status --}}
        @if (Auth::guard('student')->check())
            @php
                $me = Auth::guard('student')->user();
            @endphp
            <div class="mb-5">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 text-white transition-all duration-300 hover:bg-white/10">
                    
                    <div class="flex items-center gap-4">
                        <p class="text-xl font-semibold">{{ $me->name }}</p>
                    </div>

                    <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
                        @if ($me->sim_card_path)
                            <button type="button" 
                                wire:click="$dispatch('open-image-modal', { url: '{{ Storage::url($me->sim_card_path) }}' })"
                                class="flex h-10 w-10 items-center justify-center rounded-full border border-white/20 bg-white/10 text-white/70 transition-all duration-300 hover:bg-white/20 hover:text-white">
                                {!! icon('eye', 'h-5 w-5') !!}
                            </button>

                            <button type="button" wire:click="removeMyImage"
                                class="flex h-10 w-10 items-center justify-center rounded-full border border-red-400/20 bg-red-500/10 text-red-300/70 transition-all duration-300 hover:bg-red-500/20">
                                {!! icon('delete', 'h-5 w-5') !!}
                            </button>
                        @endif

                        <div class="relative flex-1 sm:flex-none">
                            <input type="file" wire:model="simImage" accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                            
                            <button type="button"
                                class="flex h-10 w-10 items-center justify-center rounded-full border border-yellow-400/20 bg-yellow-500/10 text-yellow-300/70 transition-all duration-300 hover:bg-yellow-500/20">
                                <span wire:loading.remove wire:target="simImage">
                                    {!! icon('pencil', 'h-5 w-5') !!}
                                </span>
                                <span wire:loading wire:target="simImage">...</span>
                            </button>
                        </div>
                    </div>
                    
                </div>
                @error('simImage') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
            <div class="mb-5 border-b border-white/10"></div>
        @endif

        {{-- Daftar Siswa --}}
        <div class="space-y-4">
            @forelse ($students as $student)
                @if (Auth::guard('student')->check() && Auth::id() === $student->id)
                    @continue
                @endif

                <div class="flex items-center justify-between gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 text-white transition-all duration-300 hover:bg-white/10">
                    <p class="text-xl font-semibold">{{ $student->name }}</p>

                    <div class="flex items-center gap-3">
                        <x-status-badge :status="$student->sim_card_path ? 'hadir' : 'alpha'" 
                                        :label="$student->sim_card_path ? 'Memiliki SIM' : 'Tidak Memiliki SIM'" />

                        @if(Auth::guard('teacher')->check() && $student->sim_card_path)
                            <button type="button" 
                                wire:click="$dispatch('open-image-modal', { url: '{{ Storage::url($student->sim_card_path) }}' })"
                                class="flex h-10 w-10 items-center justify-center rounded-full border border-white/20 bg-white/10 text-white/70 transition-all duration-300 hover:bg-white/20 hover:text-white">
                                {!! icon('eye', 'h-5 w-5') !!}
                            </button>

                            <button type="button"
                                wire:click="confirmDelete({{ $student->id }}, '{{ addslashes($student->name) }}')"
                                class="flex h-10 w-10 items-center justify-center rounded-full border border-red-400/20 bg-red-500/10 text-red-300/70 transition-all duration-300 hover:bg-red-500/20">
                                {!! icon('delete', 'h-5 w-5') !!}
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <x-empty-state message="Belum ada data siswa." icon="people" />
            @endforelse
        </div>
    </section>
</section>