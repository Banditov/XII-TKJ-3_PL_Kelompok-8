@props([
    'show' => false,
])

<div x-data="loadingScreen()" x-init="init()" x-show="show" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[9999] flex items-center justify-center bg-slate-950 backdrop-blur-sm"
    style="display: none;">

    <div class="flex flex-col items-center gap-6">
        <div class="relative">
            <div class="w-20 h-20 border-4 border-blue-500/20 rounded-full animate-spin">
                <div class="absolute inset-0 border-4 border-transparent border-t-blue-500 rounded-full"></div>
            </div>
            <div class="absolute inset-2 w-16 h-16 border-4 border-purple-500/20 rounded-full animate-spin-slow">
                <div class="absolute inset-0 border-4 border-transparent border-t-purple-500 rounded-full"></div>
            </div>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-3 h-3 bg-blue-500 rounded-full animate-pulse"></div>
            </div>
        </div>
    </div>
</div>