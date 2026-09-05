<div x-data="{ show: false }" class="w-full flex items-center justify-between h-full flex-col gap-6">
    <div></div> {{-- Spacer --}}

    <img src="{{ asset('images/logo-logimm.png') }}" class="w-120 drop-shadow-2xl 4xs:zoom-60 3xs:zoom-70 2xs:zoom-75 xs:zoom-80 sm:zoom-70 md:75 lg:zoom-80 xl:zoom-85 2xl:zoom-85">

    <div
        class="glass bg-black/20 backdrop-blur-[5px] border border-black/15 rounded-t-[80px] shadow-2xl shadow-black/60 py-10 px-15 w-160 text-center text-white transition-all duration-300 hover:shadow-black/80 4xs:zoom-60 3xs:zoom-70 2xs:zoom-75 xs:zoom-80 sm:zoom-70 md:75 lg:zoom-80 xl:zoom-85 2xl:zoom-85">

        <p class="text-5xl font-bold mb-10 text-white">Login</p>

        <div class="text-white/40 mb-10">
            <p class="text-2xl">"Sebuah Quote"</p>
            <p class="text-xl">- Nama Penulis</p>
        </div>

        <form wire:submit="login" class="flex flex-col items-center gap-6 mb-25 zoom-120">
            {{-- Email Field --}}
            <div class="text-left w-full">
                <label for="email" class="block text-sm font-medium text-white/70 mb-2 tracking-wide">
                    Email Address
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center">
                        <p class="text-white/30">@</p>
                    </div>
                    <input type="email" id="email" wire:model="email" autofocus
                        class="w-full pl-12 pr-4 py-4 bg-white/5 backdrop-blur-sm border border-white/15 rounded-xl text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400/30 focus:border-blue-400/30 transition-all duration-300 hover:bg-white/10"
                        placeholder="Masukkan email Anda">
                </div>
                @error('email')
                    <span class="text-red-400 text-sm mt-1.5 flex items-center gap-1">
                        {!! icon('important', 'w-4 h-4') !!}
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Password Field --}}
            <div class="text-left w-full mb-10">
                <label for="password" class="block text-sm font-medium text-white/70 mb-2 tracking-wide">
                    Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center">
                        {!! icon('lock', 'h-5 w-5 text-white/30') !!}
                    </div>
                    <input type="password" id="password" wire:model="password" :type="show ? 'text' : 'password'"
                        class="w-full pl-12 pr-14 py-4 bg-white/5 backdrop-blur-sm border border-white/15 rounded-xl text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400/30 focus:border-blue-400/30 transition-all duration-300 hover:bg-white/10"
                        placeholder="Masukkan password Anda">
                    <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-white/40 hover:text-white/70 transition-colors">
                        <span x-show="!show">
                            {!! icon('eye', 'h-5 w-5 text-white/30') !!}
                        </span>
                        <span x-show="show" x-cloak>
                            {!! icon('eye-slash', 'h-5 w-5 text-white/30') !!}
                        </span>
                    </button>
                </div>
                @error('password')
                    <span class="text-red-400 text-sm mt-1.5 flex items-center gap-1">
                        {!! icon('important', 'w-4 h-4') !!}
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Button --}}
            <button type="submit" wire:loading.attr="disabled" wire:target="login"
                class="relative bg-linear-to-r from-[#4AA9ED] to-[#3a8fd4] hover:from-[#3a8fd4] hover:to-[#2a7fb4] transition-all duration-300 text-white font-bold py-4 px-4 rounded-xl text-lg mt-2 shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:scale-[1.02] active:scale-95 overflow-hidden group disabled:opacity-70 disabled:cursor-not-allowed w-75">
                <span class="relative z-10 flex items-center justify-center gap-2">
                    {!! icon('logout', 'w-8 h-8 text-white') !!}
                    Masuk
                </span>
                <div
                    class="absolute inset-0 bg-white/20 -translate-x-full group-hover:translate-x-full transition-transform duration-700 skew-x-12">
                </div>
            </button>
        </form>

        <p class="text-white/20 text-xs mt-8 tracking-widest">
            &copy; {{ date('Y') }} SMK Kristen Immanuel. All rights reserved.
        </p>
    </div>
</div>