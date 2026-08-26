<div x-data="{ show: false }" class="w-full max-w-2xl mx-auto mt-auto mb-0">
    <!-- Logo -->
    <img src="{{ asset('images/logo-smk-immanuel.png') }}" class="w-56 mx-auto mb-6 relative drop-shadow-2xl">

    <!-- Glass-morphism card -->
    <div class="relative bg-black/10 backdrop-blur-xl backdrop-saturate-[1.8] border border-black/15 rounded-t-3xl rounded-b-none shadow-2xl shadow-black/60 p-10 sm:p-14 text-center text-white transition-all duration-300 hover:shadow-black/80">
        <!-- Glass refraction effects -->
        <div class="absolute inset-0 rounded-t-3xl rounded-b-none bg-gradient-to-br from-white/5 via-transparent to-transparent pointer-events-none"></div>
        <div class="absolute inset-0 rounded-t-3xl rounded-b-none bg-gradient-to-t from-black/30 to-transparent pointer-events-none"></div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>

        <!-- Inner glow -->
        <div class="absolute -top-24 -left-24 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-purple-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white/5 rounded-full blur-3xl pointer-events-none"></div>

        <p class="text-5xl font-bold mb-2 relative bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">
            Welcome Back
        </p>
        <p class="text-white/40 text-sm mb-8 relative">Sign in to continue your journey</p>

        <form wire:submit.prevent="login" class="flex flex-col gap-6 relative">
            <!-- Email Field -->
            <div class="text-left">
                <label for="email" class="block text-sm font-medium text-white/70 mb-2 tracking-wide">
                    Email Address
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input type="email" id="email" wire:model.defer="email" required autofocus
                        class="w-full pl-12 pr-4 py-4 bg-white/5 backdrop-blur-sm border border-white/15 rounded-xl text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400/30 focus:border-blue-400/30 transition-all duration-300 hover:bg-white/10 @error('email') border-red-400 focus:ring-red-400/30 @enderror"
                        placeholder="Enter your email">
                </div>
                @error('email')
                    <span class="text-red-400 text-sm mt-1.5 block flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="text-left">
                <label for="password" class="block text-sm font-medium text-white/70 mb-2 tracking-wide">
                    Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input type="password" id="password" wire:model.defer="password" required
                        :type="show ? 'text' : 'password'"
                        class="w-full pl-12 pr-14 py-4 bg-white/5 backdrop-blur-sm border border-white/15 rounded-xl text-white placeholder-white/30 focus:outline-none focus:ring-2 focus:ring-blue-400/30 focus:border-blue-400/30 transition-all duration-300 hover:bg-white/10 @error('password') border-red-400 focus:ring-red-400/30 @enderror"
                        placeholder="Enter your password">
                    <button type="button" @click="show = !show"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-white/40 hover:text-white/70 transition-colors">
                        <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                        <svg x-show="show" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <span class="text-red-400 text-sm mt-1.5 block flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" wire:loading.attr="disabled"
                class="relative bg-gradient-to-r from-[#4AA9ED] to-[#3a8fd4] hover:from-[#3a8fd4] hover:to-[#2a7fb4] transition-all duration-300 text-white font-bold py-4 px-4 rounded-xl text-lg mt-2 shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 hover:scale-[1.02] active:scale-95 overflow-hidden group disabled:opacity-70 disabled:cursor-not-allowed">
                <span wire:loading.remove class="relative z-10 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Sign In
                </span>

                <span wire:loading class="relative z-10 flex flex-row items-center justify-center gap-2">
                    <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Signing in...
                </span>

                <div class="absolute inset-0 bg-white/20 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700 skew-x-12">
                </div>
            </button>
        </form>

        <p class="text-white/20 text-xs mt-8 tracking-widest relative">
            &copy; {{ date('Y') }} SMK Kristen Immanuel. All rights reserved.
        </p>
    </div>
</div>