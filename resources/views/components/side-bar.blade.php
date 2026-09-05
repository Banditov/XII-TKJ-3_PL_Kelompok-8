{{-- Desktop --}}
<aside class="glass hidden sm:flex sm:zoom-80 md:zoom-85 lg:zoom-90 xl:zoom-95 2xl:zoom-100 w-22.5 shrink-0 h-full flex-col items-center justify-between bg-black/20 backdrop-blur-[5px] border-r border-white/10 py-5">
    <div class="w-full flex flex-col items-center gap-6">
        <img src="{{ asset('images/logo-sekolah.png') }}" alt="School Logo" class="h-12 w-12 object-contain">

        <nav class="flex flex-col items-center gap-4">
            <div class="w-full h-0.5 bg-white rounded-full"></div>
            <button type="button" class="flex h-12 w-12 items-center rounded-br-none rounded-tr-none justify-center rounded-2xl text-slate-300 transition-all duration-300 hover:scale-105 hover:bg-white/5 hover:text-white">
                {!! icon('group', 'h-8 w-8') !!}
            </button>
            <button type="button" class="flex h-12 w-12 items-center rounded-br-none rounded-tr-none border-r-2 border-white justify-center rounded-2xl bg-linear-to-br from-blue-300/30 to-blue-500/15 text-blue-100 shadow-md shadow-blue-300/20 ring-1 ring-white/10 transition-all duration-300 hover:scale-105">
                {!! icon('clipboard', 'h-8 w-8 text-white') !!}
            </button>
            <button type="button" class="flex h-12 w-12 items-center rounded-br-none rounded-tr-none justify-center rounded-2xl text-slate-300 transition-all duration-300 hover:scale-105 hover:bg-white/5 hover:text-white">
                {!! icon('calendar', 'h-8 w-8') !!}
            </button>
            <button type="button" class="flex h-12 w-12 items-center rounded-br-none rounded-tr-none justify-center rounded-2xl text-slate-300 transition-all duration-300 hover:scale-105 hover:bg-white/5 hover:text-white">
                {!! icon('id', 'h-8 w-8') !!}
            </button>
        </nav>
    </div>

    <div class="flex flex-col items-center gap-4">
        <div class="w-full h-0.5 bg-white rounded-full"></div>
        <button type="button" class="flex h-12 w-12 items-center rounded-br-none rounded-tr-none justify-center rounded-2xl text-slate-300 transition-all duration-300 hover:scale-105 hover:bg-white/5 hover:text-white">
            {!! icon('logout', 'h-8 w-8') !!}
        </button>
    </div>
</aside>

{{-- Mobile --}}
<nav class="flex sm:hidden fixed bottom-0 left-0 z-50 w-full items-center">
    <button type="button" class="flex aspect-square w-[20%] items-center justify-center border-t-6 border-black/50 bg-gray-900 rounded-tr-[50%] text-slate-300 transition-all duration-300 hover:bg-gray-800 hover:text-white">
        {!! icon('group', 'aspect-square w-[50%]') !!}
    </button>
    <button type="button" class="flex aspect-square w-[20%] items-center justify-center border-t-6 border-white/50 rounded-t-2xl bg-linear-to-br from-blue-300 to-blue-500 text-blue-100 shadow-md shadow-blue-300/20 ring-1 ring-white/10 transition-all duration-300">
        {!! icon('clipboard', 'aspect-square w-[50%] text-white') !!}
    </button>
    <button type="button" class="flex aspect-square w-[20%] items-center justify-center border-t-6 border-black/50 bg-gray-900 rounded-t-[50%] text-slate-300 transition-all duration-300 hover:bg-gray-800 hover:text-white">
        {!! icon('calendar', 'aspect-square w-[50%]') !!}
    </button>
    <button type="button" class="flex aspect-square w-[20%] items-center justify-center border-t-6 border-black/50 bg-gray-900 rounded-t-[50%] text-slate-300 transition-all duration-300 hover:bg-gray-800 hover:text-white">
        {!! icon('id', 'aspect-square w-[50%]') !!}
    </button>
    <button type="button" class="flex aspect-square w-[20%] items-center justify-center border-t-6 border-black/50 bg-gray-900 rounded-tl-[50%] text-slate-300 transition-all duration-300 hover:bg-gray-800 hover:text-white">
        {!! icon('logout', 'aspect-square w-[50%]') !!}
    </button>
</nav>