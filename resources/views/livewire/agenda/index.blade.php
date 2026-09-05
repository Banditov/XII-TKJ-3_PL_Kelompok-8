<div 
    class="glass 4xs:h-[85%] sm:h-[90%] sm:w-full 4xs:w-auto m-15 p-5 rounded-3xl bg-black/20 backdrop-blur-[5px] border border-white/10 shadow-2xl shadow-black/60 4xs:zoom-70 2xs:zoom-75 xs:zoom-80 sm:zoom-70 md:zoom-75 lg:zoom-80 xl:zoom-85 2xl:zoom-85">
    <!-- Header -->
    <header class="mb-8 flex items-center justify-between">
        <div class="flex flex-col gap-2 text-white">
            <h1 class="text-5xl font-bold">Agenda</h1>
            <p class="font-semibold">XII TKJ 3</p>
        </div>

        <button
            class="flex items-center gap-2 rounded-[14px] border border-white/20 bg-white/5 px-4 py-2.5 text-lg font-semibold text-white shadow-lg shadow-black/20 transition-all duration-300 hover:bg-white/10 hover:scale-[1.02] active:scale-95">
            <p>Tambah</p>
            <p class="text-2xl leading-none">+</p>
        </button>
    </header>

    <!-- Stats Cards -->
    <div class="mb-7 grid grid-cols-3 gap-5 4xs:zoom-60 xs:zoom-70 sm:zoom-80 md:zoom-90 lg:zoom-100 xl:zoom-110 2xl:zoom-120">
        <div
            class="rounded-[18px] border flex gap-5 items-center border-blue-400/20 bg-white/5 p-4 shadow-xl shadow-black/20 backdrop-blur-sm transition-all duration-300 hover:bg-white/10">
            <div
                class="flex h-20 w-20 items-center justify-center rounded-full border border-blue-400/20 bg-blue-500/10 text-blue-300/70">
                {!! icon('task', 'h-10 w-10') !!}
            </div>
            <div class="flex flex-col">
                <div class="text-3xl font-bold text-white">{{ count($tasksNow) }}</div>
                <p class="mt-3 hidden md:block text-lg font-medium text-white/60">Tugas Sekarang</p>
            </div>
        </div>
        <div
            class="rounded-[18px] border flex gap-5 items-center border-red-400/20 bg-white/5 p-4 shadow-xl shadow-black/20 backdrop-blur-sm transition-all duration-300 hover:bg-white/10">
            <div
                class="flex h-20 w-20 items-center justify-center rounded-full border border-red-400/20 bg-red-500/10 text-red-300/70">
                {!! icon('important', 'h-10 w-10') !!}
            </div>
            <div class="flex flex-col">
                <div class="text-3xl font-bold text-white">{{ count($tasksNow) }}</div>
                <p class="mt-3 hidden md:block text-lg font-medium text-white/60">Kumpul Hari Ini</p>
            </div>
        </div>
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
                <button type="button" @click="open = !open" class="transition-transform duration-300" :class="{ 'rotate-180': !open }">
                    {!! icon('arrow', 'text-white h-8 w-8') !!}
                </button>
            </div>

            <div x-show="open"
                x-collapse
                class="flex min-h-40 items-center justify-center rounded-[18px] border border-white/10 bg-white/5 p-6 shadow-inner shadow-black/20 backdrop-blur-sm 4xs:zoom-60 3xs:zoom-80 sm:zoom-100">
                @if (count($tasksNow) === 0)
                    <div class="flex flex-col items-center gap-4 text-white/40">
                        {!! icon('task', 'h-12 w-12') !!}
                        <p class="text-3xl font-semibold">Tidak ada tugas! :D</p>
                    </div>
                @else
                    @foreach ($tasksNow as $task)
                        <div class="w-full rounded-2xl border border-white/10 bg-white/5 p-4 text-white transition-all duration-300 hover:bg-white/10">
                            <p>{{ $task['title'] }}</p>
                        </div>
                    @endforeach
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
                <button type="button" @click="open = !open" class="transition-transform duration-300" :class="{ 'rotate-180': !open }">
                    {!! icon('arrow', 'text-white h-8 w-8') !!}
                </button>
            </div>

            <div x-show="open"
                x-collapse
                class="rounded-[18px] border border-white/10 bg-white/5 p-4 shadow-inner shadow-black/20 backdrop-blur-sm">
                @foreach ($lateTasks as $lateTask)
                    <div class="flex items-center justify-between gap-4 rounded-2xl border border-white/10 bg-white/5 p-4 text-white transition-all duration-300 hover:bg-white/10">
                        <div class="flex flex-col gap-2 w-full">
                            <div class="flex gap-2 sm:items-center justify-center sm:justify-start items-start sm:flex-row flex-col sm:gap-8">
                                <p class="text-2xl font-semibold">{{ $lateTask['title'] }}</p>
                                <div class="flex gap-2">
                                    <div class="flex items-center justify-center">
                                        {!! icon('calendar', 'h-5 w-5') !!}
                                    </div>
                                    <span>{{ $lateTask['date'] }}</span>
                                </div>
                            </div>
                            <span>{{ $lateTask['description'] }}</span>
                        </div>

                        <div class="flex items-center gap-3">
                            <button class="flex h-10 w-10 items-center justify-center rounded-full border border-yellow-400/20 bg-yellow-500/10 text-yellow-300/50 transition-all duration-300 hover:bg-yellow-500/20 hover:text-yellow-300/80">
                                {!! icon('pencil', 'h-5 w-5') !!}
                            </button>
                            <button class="flex h-10 w-10 items-center justify-center rounded-full border border-red-400/20 bg-red-500/10 text-red-300/50 transition-all duration-300 hover:bg-red-500/20 hover:text-red-300/80">
                                {!! icon('delete', 'h-5 w-5') !!}
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>