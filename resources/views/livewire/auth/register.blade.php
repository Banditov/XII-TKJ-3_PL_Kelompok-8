<div x-data="{ show: false }" class="w-full flex items-center justify-between h-full flex-col gap-6">
    <div></div> {{-- Spacer --}}

    <img src="{{ asset('images/logo-logimm.png') }}"
        class="w-120 drop-shadow-2xl 4xs:zoom-60 3xs:zoom-70 2xs:zoom-75 xs:zoom-80 sm:zoom-70 md:75 lg:zoom-80 xl:zoom-85 2xl:zoom-85">

    <div class="glass bg-black/20 backdrop-blur-[5px] border border-black/15 rounded-t-[80px] shadow-2xl shadow-black/60 py-10 px-15 w-160 text-center text-white transition-all duration-300 hover:shadow-black/80 4xs:zoom-60 3xs:zoom-70 2xs:zoom-75 xs:zoom-80 sm:zoom-70 md:75 lg:zoom-80 xl:zoom-85 2xl:zoom-85">

        <p class="text-5xl font-bold mb-7 text-white">Registrasi</p>

        <form wire:submit="register" class="flex flex-col items-center gap-4 mb-15 zoom-120">

            {{-- Role Selector --}}
            <div class="flex gap-3 w-full mb-2">
                <button type="button"
                    wire:click="$set('role', 'student')"
                    class="flex-1 py-3 rounded-xl font-semibold transition-all duration-300 border
                        {{ $role === 'student'
                            ? 'bg-linear-to-r from-blue-500 to-sky-300 border-white/30 text-white shadow-lg shadow-blue-500/30'
                            : 'bg-white/5 border-white/15 text-white/60 hover:bg-white/10' }}">
                    Siswa
                </button>
                <button type="button"
                    wire:click="$set('role', 'teacher')"
                    class="flex-1 py-3 rounded-xl font-semibold transition-all duration-300 border
                        {{ $role === 'teacher'
                            ? 'bg-linear-to-r from-blue-500 to-sky-300 border-white/30 text-white shadow-lg shadow-blue-500/30'
                            : 'bg-white/5 border-white/15 text-white/60 hover:bg-white/10' }}">
                    Guru
                </button>
            </div>

            {{-- Name --}}
            <div class="text-left w-full">
                <label for="name" class="block text-sm font-medium text-white/70 mb-2 tracking-wide">
                    Nama Lengkap
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center">
                        {!! icon('person', 'w-5 h-5 text-white/30') !!}
                    </div>
                    <input type="text" id="name" wire:model="name" autofocus
                        class="w-full pl-12 pr-4 py-4 bg-white/5 backdrop-blur-sm border border-white/15 rounded-xl text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400/30 focus:border-blue-400/30 transition-all duration-300 hover:bg-white/10"
                        placeholder="Masukkan nama lengkap">
                </div>
                @error('name')
                    <span class="text-red-400 text-sm mt-1.5 flex items-center gap-1">
                        {!! icon('important', 'w-4 h-4') !!} {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Email --}}
            <div class="text-left w-full">
                <label for="email" class="block text-sm font-medium text-white/70 mb-2 tracking-wide">
                    Email
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center">
                        <p class="text-white/30">@</p>
                    </div>
                    <input type="email" id="email" wire:model="email"
                        class="w-full pl-12 pr-4 py-4 bg-white/5 backdrop-blur-sm border border-white/15 rounded-xl text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400/30 focus:border-blue-400/30 transition-all duration-300 hover:bg-white/10"
                        placeholder="Masukkan email">
                </div>
                @error('email')
                    <span class="text-red-400 text-sm mt-1.5 flex items-center gap-1">
                        {!! icon('important', 'w-4 h-4') !!} {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Class --}}
            @if ($role === 'student')
                <div class="text-left w-full">
                    <label for="class_id" class="block text-sm font-medium text-white/70 mb-2 tracking-wide">
                        Kelas
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            {!! icon('people', 'w-5 h-5 text-white/30') !!}
                        </div>
                        <select id="class_id" wire:model="class_id"
                            class="w-full pl-12 pr-10 py-4 bg-white/5 backdrop-blur-sm border border-white/15 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-blue-400/30 focus:border-blue-400/30 transition-all duration-300 hover:bg-white/10 appearance-none cursor-pointer">
                            <option value="" class="bg-slate-900 text-white/60">Pilih Kelas</option>
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}" class="bg-slate-900 text-white">{{ $class->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                            {!! icon('arrow', 'w-6 h-6 text-white/30') !!}
                        </div>
                    </div>
                    @error('class_id')
                        <span class="text-red-400 text-sm mt-1.5 flex items-center gap-1">
                            {!! icon('important', 'w-4 h-4') !!} {{ $message }}
                        </span>
                    @enderror
                </div>
            @endif

            {{-- Password --}}
            <div class="text-left w-full mb-7">
                <label for="password" class="block text-sm font-medium text-white/70 mb-2 tracking-wide">
                    Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center">
                        {!! icon('lock', 'h-5 w-5 text-white/30') !!}
                    </div>
                    <input type="password" id="password" wire:model="password" :type="show ? 'text' : 'password'"
                        class="w-full pl-12 pr-14 py-4 bg-white/5 backdrop-blur-sm border border-white/15 rounded-xl text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400/30 focus:border-blue-400/30 transition-all duration-300 hover:bg-white/10"
                        placeholder="Minimal 8 karakter">
                    <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-white/40 hover:text-white/70 transition-colors">
                        <span x-show="!show">{!! icon('eye-slash', 'h-5 w-5 text-white/30') !!}</span>
                        <span x-show="show" x-cloak>{!! icon('eye', 'h-5 w-5 text-white/30') !!}</span>
                    </button>
                </div>
                @error('password')
                    <span class="text-red-400 text-sm mt-1.5 flex items-center gap-1">
                        {!! icon('important', 'w-4 h-4') !!} {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex gap-10 w-full">
                <a href="{{ route('login') }}"
                    class="relative bg-linear-to-r from-[#ed4a4a] to-[#d43a3a] hover:from-[#d43a3a] hover:to-[#b42a2a] transition-all duration-300 text-white font-bold py-4 px-4 rounded-xl text-lg mt-2 shadow-lg shadow-red-500/30 hover:shadow-red-500/50 hover:scale-[1.02] active:scale-95 overflow-hidden group w-full text-center">
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        {!! icon('logout', 'w-8 h-8 text-white') !!}
                        Kembali
                    </span>
                    <div class="absolute inset-0 bg-white/20 -translate-x-full group-hover:translate-x-full transition-transform duration-700 skew-x-12"></div>
                </a>
                <button type="submit" wire:loading.attr="disabled" wire:target="register"
                    class="relative bg-linear-to-r from-[#4AA9ED] to-[#3a8fd4] hover:from-[#3a8fd4] hover:to-[#2a7fb4] transition-all duration-300 text-white font-bold py-4 px-4 rounded-xl text-lg mt-2 shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:scale-[1.02] active:scale-95 overflow-hidden group disabled:opacity-70 disabled:cursor-not-allowed w-full">
                    <span class="relative z-10 flex items-center justify-center gap-2">
                        {!! icon('add', 'w-8 h-8 text-white') !!}
                        Buat
                    </span>
                    <div class="absolute inset-0 bg-white/20 -translate-x-full group-hover:translate-x-full transition-transform duration-700 skew-x-12"></div>
                </button>
            </div>
        </form>

        <p class="text-white/20 text-xs mt-8 tracking-widest">
            &copy; {{ date('Y') }} SMK Kristen Immanuel. All rights reserved.
        </p>
    </div>
</div>