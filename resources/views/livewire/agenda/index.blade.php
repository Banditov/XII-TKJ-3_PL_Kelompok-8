<div class="flex h-[calc(100vh-1.7rem)] w-full overflow-hidden rounded-[24px] border border-white/10 bg-[#0c1738]/80 shadow-[0_15px_50px_rgba(0,0,0,0.5)] backdrop-blur-sm">
    <aside class="flex w-[90px] flex-col items-center justify-between border-r border-white/10 bg-gradient-to-b from-[#0a1738] via-[#0d1d4d] to-[#102a66] py-5">
        <div class="w-full">
            <div class="mb-7 flex justify-center px-3">
                <div class="flex h-14 w-14 items-center justify-center rounded-[18px] border border-white/10 bg-white/5 shadow-lg shadow-blue-500/20">
                    <span class="text-xl font-black text-white">SM</span>
                </div>
            </div>

            <nav class="flex flex-col items-center gap-4">
                <button class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-blue-500/30 to-blue-400/15 text-blue-100 shadow-md shadow-blue-500/20 ring-1 ring-white/10 transition hover:scale-105">
                    {!! icon('agenda', 'h-6 w-6 text-white') !!}
                </button>
                <button class="flex h-12 w-12 items-center justify-center rounded-2xl text-slate-300 transition hover:scale-105 hover:bg-white/5 hover:text-white">
                    {!! icon('task', 'h-6 w-6') !!}
                </button>
                <button class="flex h-12 w-12 items-center justify-center rounded-2xl text-slate-300 transition hover:scale-105 hover:bg-white/5 hover:text-white">
                    {!! icon('calendar', 'h-6 w-6') !!}
                </button>
                <button class="flex h-12 w-12 items-center justify-center rounded-2xl text-slate-300 transition hover:scale-105 hover:bg-white/5 hover:text-white">
                    {!! icon('person', 'h-6 w-6') !!}
                </button>
                <button class="flex h-12 w-12 items-center justify-center rounded-2xl text-slate-300 transition hover:scale-105 hover:bg-white/5 hover:text-white">
                    {!! icon('settings', 'h-6 w-6') !!}
                </button>
            </nav>
        </div>

        <button class="flex h-12 w-12 items-center justify-center rounded-2xl text-slate-300 transition hover:scale-105 hover:bg-white/5 hover:text-white">
            {!! icon('logout', 'h-6 w-6') !!}
        </button>
    </aside>

    <section class="relative flex-1 overflow-hidden bg-[#07182d] px-6 py-5">
        <div class="absolute inset-0 opacity-90" style="background:linear-gradient(135deg,rgba(30,64,175,.23),rgba(37,99,235,.08),rgba(15,23,42,0));"></div>
        <div class="absolute inset-0" style="background:linear-gradient(120deg, transparent 0%, rgba(255,255,255,0.03) 45%, transparent 60%);"></div>
        <div class="absolute -left-24 top-12 h-72 w-72 rounded-full bg-blue-500/15 blur-3xl"></div>
        <div class="absolute right-0 top-1/3 h-80 w-80 rounded-full bg-cyan-500/10 blur-3xl"></div>

        <div class="relative z-10 h-full">
            <header class="mb-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <h1 class="text-4xl font-bold text-white">Agenda</h1>
                    <div class="mt-2 text-sm text-blue-200/80">
                        <span class="font-semibold">XII TKJ 3</span>
                    </div>
                </div>

                <button class="flex items-center gap-2 rounded-[14px] border border-blue-300/25 bg-[#5a9ef6]/20 px-4 py-2.5 text-lg font-semibold text-white shadow-lg shadow-blue-500/20 transition hover:bg-[#5a9ef6]/30">
                    <span>Tambah</span>
                    <span class="text-2xl leading-none">+</span>
                </button>
            </header>

            <div class="mb-7 grid grid-cols-3 gap-5">
                <div class="rounded-[18px] border border-white/10 bg-[#101a2d]/80 p-4 shadow-xl shadow-slate-950/30">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-400/20 bg-slate-900/90 text-slate-200">
                            {!! icon('task', 'h-5 w-5') !!}
                        </div>
                        <div class="text-3xl font-bold text-white">{{ count($tasksNow) }}</div>
                    </div>
                    <p class="mt-3 text-lg font-medium text-slate-200">Tugas Sekarang</p>
                </div>

                <div class="rounded-[18px] border border-red-400/30 bg-[#1a1118]/80 p-4 shadow-xl shadow-red-950/20">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl border border-red-300/30 bg-red-900/80 text-red-200">
                            {!! icon('important', 'h-5 w-5') !!}
                        </div>
                        <div class="text-3xl font-bold text-white">0</div>
                    </div>
                    <p class="mt-3 text-lg font-medium text-slate-200">Kumpul Hari Ini</p>
                </div>

                <div class="rounded-[18px] border border-slate-400/20 bg-[#101a2d]/80 p-4 shadow-xl shadow-slate-950/30">
                    <div class="flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-400/20 bg-slate-900/90 text-slate-200">
                            {!! icon('correct', 'h-5 w-5') !!}
                        </div>
                        <div class="text-3xl font-bold text-white">{{ count($lateTasks) }}</div>
                    </div>
                    <p class="mt-3 text-lg font-medium text-slate-200">Sudah Lewat</p>
                </div>
            </div>

            <div class="space-y-8">
                <div>
                    <div class="mb-4 flex items-center gap-3 px-2">
                        <span class="h-6 w-1 rounded-full bg-blue-400"></span>
                        <h2 class="text-3xl font-bold text-white">Tugas Sekarang</h2>
                        <span class="text-2xl font-semibold text-blue-300">{{ count($tasksNow) }}</span>
                    </div>

                    <div class="flex min-h-[160px] items-center justify-center rounded-[18px] border border-white/10 bg-[#111827]/80 px-6 py-8 shadow-inner shadow-black/20">
                        @if (count($tasksNow) === 0)
                            <div class="flex flex-col items-center gap-4 text-slate-200/80">
                                {!! icon('task', 'h-12 w-12 text-slate-300') !!}
                                <p class="text-3xl font-semibold text-slate-200">Tidak ada tugas! :D</p>
                            </div>
                        @else
                            @foreach ($tasksNow as $task)
                                <div class="w-full rounded-2xl border border-white/10 bg-white/5 p-4 text-white">
                                    <p>{{ $task['title'] }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div>
                    <div class="mb-4 flex items-center gap-3 px-2">
                        <span class="h-6 w-1 rounded-full bg-slate-300"></span>
                        <h2 class="text-3xl font-bold text-white">Sudah Lewat</h2>
                        <span class="text-2xl font-semibold text-slate-300">{{ count($lateTasks) }}</span>
                    </div>

                    <div class="rounded-[18px] border border-white/10 bg-[#111827]/80 p-4 shadow-inner shadow-black/20">
                        @foreach ($lateTasks as $lateTask)
                            <div class="flex items-center justify-between gap-4 rounded-[16px] border border-white/10 bg-[#1b2435]/70 p-4 text-white">
                                <div class="flex items-center gap-4">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/5 text-slate-200">
                                        {!! icon('calendar', 'h-5 w-5') !!}
                                    </div>
                                    <div>
                                        <p class="text-2xl font-semibold">{{ $lateTask['title'] }}</p>
                                        <div class="mt-1 flex items-center gap-3 text-slate-300">
                                            <span>{{ $lateTask['date'] }}</span>
                                            <span class="inline-block h-1 w-1 rounded-full bg-slate-500"></span>
                                            <span>{{ $lateTask['description'] }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3">
                                    <button class="flex h-10 w-10 items-center justify-center rounded-full border border-yellow-400/30 bg-yellow-500/10 text-yellow-300 transition hover:bg-yellow-500/20">
                                        {!! icon('pencil', 'h-5 w-5') !!}
                                    </button>
                                    <button class="flex h-10 w-10 items-center justify-center rounded-full border border-red-400/30 bg-red-500/10 text-red-300 transition hover:bg-red-500/20">
                                        {!! icon('delete', 'h-5 w-5') !!}
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
