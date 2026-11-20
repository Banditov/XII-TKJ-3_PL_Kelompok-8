<section>
    <!-- Header -->
    <header class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex flex-col gap-2 text-white">
            <h1 class="text-5xl font-bold">Agenda</h1>
            <p class="font-semibold">{{ $this->className }}</p>
        </div>

        <div class="flex items-center gap-4">
            <x-class-selector :classes="$classes ?? []" selected="selectedClassId"
                :isTeacher="Auth::guard('teacher')->check()" />

            <a href="{{ route('agenda.create', ['class_id' => $selectedClassId]) }}" wire:navigate
                class="flex items-center gap-2 rounded-[14px] bg-linear-to-r from-blue-500 to-sky-300 px-4 py-2.5 text-lg font-semibold text-white shadow-lg shadow-black/20 transition-all duration-300 hover:scale-[1.02] active:scale-95">
                <p class="4xs:hidden sm:block">Tambah</p>
                <p class="text-2xl leading-none">+</p>
            </a>
        </div>
    </header>

    {{-- Success Message --}}
    @if (session()->has('success'))
        <div class="mb-6 rounded-xl border border-emerald-400/20 bg-emerald-500/10 p-4 text-emerald-300">
            {{ session('success') }}
        </div>
    @endif

    <!-- Stats Cards -->
    <div
        class="mb-7 grid grid-cols-3 gap-5 4xs:zoom-60 xs:zoom-70 sm:zoom-80 md:zoom-90 lg:zoom-100 xl:zoom-110 2xl:zoom-120">
        {{-- Tugas Mendatang --}}
        <div
            class="rounded-[18px] border flex gap-5 items-center border-blue-400/20 bg-white/5 p-4 shadow-xl shadow-black/20 backdrop-blur-sm transition-all duration-300 hover:bg-white/10">
            <div
                class="flex h-20 w-20 items-center justify-center rounded-full border border-blue-400/20 bg-blue-500/10 text-blue-300/70">
                {!! icon('task', 'h-10 w-10') !!}
            </div>
            <div class="flex flex-col">
                <div class="text-3xl font-bold text-white">{{ count($upcomingTasks) }}</div>
                <p class="mt-3 hidden md:block text-lg font-medium text-white/60">Tugas Mendatang</p>
            </div>
        </div>

        {{-- Tugas Hari Ini --}}
        <div
            class="rounded-[18px] border flex gap-5 items-center border-red-400/20 bg-white/5 p-4 shadow-xl shadow-black/20 backdrop-blur-sm transition-all duration-300 hover:bg-white/10">
            <div
                class="flex h-20 w-20 items-center justify-center rounded-full border border-red-400/20 bg-red-500/10 text-red-300/70">
                {!! icon('important', 'h-10 w-10') !!}
            </div>
            <div class="flex flex-col">
                <div class="text-3xl font-bold text-white">{{ count($tasksToday) }}</div>
                <p class="mt-3 hidden md:block text-lg font-medium text-white/60">Tugas Hari Ini</p>
            </div>
        </div>

        {{-- Sudah Lewat --}}
        <div
            class="rounded-[18px] border flex gap-5 items-center border-white/20 bg-white/5 p-4 shadow-xl shadow-black/20 backdrop-blur-sm transition-all duration-300 hover:bg-white/10">
            <div
                class="flex h-20 w-20 items-center justify-center rounded-full border border-white/20 bg-white/10 text-white/70">
                {!! icon('correct', 'h-10 w-10') !!}
            </div>
            <div class="flex flex-col">
                <div class="text-3xl font-bold text-white">{{ count($lateTasks) }}</div>
                <p class="mt-3 hidden md:block text-lg font-medium text-white/60">Sudah Lewat</p>
            </div>
        </div>
    </div>

    <!-- Tasks Sections -->
    <div class="space-y-8">
        <!-- Current Tasks -->
        <div x-data="{ open: true }">
            <div class="flex items-center gap-5 mb-5">
                <div class="flex items-center gap-3 4xs:zoom-80 sm:zoom-100">
                    <div class="h-8 w-1 rounded-full bg-blue-500"></div>
                    <h2 class="text-3xl font-bold text-white">Tugas Sekarang</h2>
                </div>
                <button type="button" @click="open = !open" class="transition-transform duration-300"
                    :class="{ 'rotate-180': !open }">
                    {!! icon('arrow', 'text-white h-8 w-8') !!}
                </button>
            </div>

            <div x-show="open" x-collapse
                class="flex min-h-40 items-center justify-center rounded-[18px] border border-white/10 bg-white/5 p-6 shadow-inner shadow-black/20 backdrop-blur-sm 4xs:zoom-60 3xs:zoom-80 sm:zoom-100">
                @if (count($this->tasksNow) === 0)
                    <x-empty-state message="Tidak ada tugas! :D" icon="task" />
                @else
                    <div class="w-full space-y-3">
                        @foreach ($this->tasksNow as $task)
                            @php
                                $date = \Carbon\Carbon::parse($task['date']);
                            @endphp
                            <div
                                class="flex items-center justify-between gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 text-white transition-all duration-300 hover:bg-white/10">
                                <div class="flex flex-col gap-2 w-full">
                                    <div
                                        class="flex gap-2 sm:items-center justify-center sm:justify-start items-start sm:flex-row flex-col sm:gap-8">
                                        <p class="text-2xl font-semibold">{{ $task['title'] }}</p>
                                        <div class="flex items-center gap-2">
                                            <div class="flex items-center justify-center">
                                                {!! icon('calendar', 'h-5 w-5') !!}
                                            </div>
                                            <span>
                                                @if($date->isToday())
                                                    Hari ini
                                                @elseif($date->isTomorrow())
                                                    Besok
                                                @else
                                                    {{ $date->translatedFormat('d M Y') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                    <span>{{ $task['description'] }}</span>
                                </div>

                                <x-row-actions :editRoute="route('agenda.edit', $task['id'])" :deleteId="$task['id']"
                                    deleteName="agenda ini" />
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Late Tasks -->
        <div x-data="{ open: true }">
            <div class="flex items-center gap-5 mb-5">
                <div class="flex items-center gap-3 4xs:zoom-80 sm:zoom-100">
                    <div class="h-8 w-1 rounded-full bg-white"></div>
                    <h2 class="text-3xl font-bold text-white">Sudah Lewat</h2>
                </div>
                <button type="button" @click="open = !open" class="transition-transform duration-300"
                    :class="{ 'rotate-180': !open }">
                    {!! icon('arrow', 'text-white h-8 w-8') !!}
                </button>
            </div>

            <div x-show="open" x-collapse
                class="rounded-[18px] border border-white/10 bg-white/5 p-4 shadow-inner shadow-black/20 backdrop-blur-sm">
                @forelse ($lateTasks as $lateTask)
                    @php
                        $lateDate = \Carbon\Carbon::parse($lateTask['date']);
                    @endphp

                    <div
                        class="flex items-center justify-between gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 text-white transition-all duration-300 hover:bg-white/10 mb-3 last:mb-0">
                        <div class="flex flex-col gap-2 w-full">
                            <div
                                class="flex gap-2 sm:items-center justify-center sm:justify-start items-start sm:flex-row flex-col sm:gap-8">
                                <p class="text-2xl font-semibold">{{ $lateTask['title'] }}</p>
                                <div class="flex gap-2">
                                    <div class="flex items-center justify-center">
                                        {!! icon('calendar', 'h-5 w-5') !!}
                                    </div>
                                    <span>{{ $lateDate->diffForHumans() }}</span>
                                </div>
                            </div>
                            <span>{{ $lateTask['description'] }}</span>
                        </div>

                        <x-row-actions :editRoute="route('agenda.edit', $lateTask['id'])" :deleteId="$lateTask['id']"
                            deleteName="agenda ini" />
                    </div>
                @empty
                    <x-empty-state message="Tidak ada tugas yang lewat! :D" icon="check" />
                @endforelse
            </div>
        </div>
    </div>
</section>