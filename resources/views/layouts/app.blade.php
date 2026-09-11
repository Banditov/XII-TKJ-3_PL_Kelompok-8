<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Logimm') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="overflow-hidden h-screen **:select-none">
    {{-- Loading Screen --}}
    <x-loading-screen type="spinner" />

    {{-- Background --}}
    <div class="fixed inset-0 z-0 bg-slate-950">
        <canvas id="bgCanvas" class="w-full h-full block"></canvas>

        <div class="absolute inset-0 bg-linear-to-br from-blue-500/5 via-purple-500/5 to-pink-500/5 pointer-events-none">
        </div>
        <div class="absolute inset-0 pointer-events-none"
            style="background-image:linear-gradient(rgba(255,255,255,.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.03) 1px,transparent 1px);background-size:60px 60px">
        </div>
        <div class="absolute top-20 left-10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl animate-pulse pointer-events-none">
        </div>
        <div class="absolute bottom-40 right-10 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl animate-pulse delay-1000 pointer-events-none">
        </div>
    </div>

    {{-- Page Content --}}
    <main class="flex h-full flex-col sm:flex-row">
        <x-side-bar :active="$active ?? 'absent'"/>

        <div class="flex items-center justify-center p-10 pb-0 sm:hidden">
            <img src="{{ asset('images/logo-logimm.png') }}" class="w-60 drop-shadow-2xl 4xs:zoom-60 3xs:zoom-70 2xs:zoom-75 xs:zoom-80 sm:zoom-70 md:zoom-75 lg:zoom-80 xl:zoom-85 2xl:zoom-85">
        </div>

        <div class="glass 4xs:h-[80%] sm:h-[90%] overflow-y-scroll sm:w-full 4xs:mb-30 xs:mb-35 sm:mb-15 4xs:w-auto m-15 4xs:mx-0 sm:mx-15 p-10 rounded-3xl bg-black/20 backdrop-blur-[5px] border border-white/10 shadow-2xl shadow-black/60 4xs:zoom-70 2xs:zoom-75 xs:zoom-80 sm:zoom-70 md:zoom-75 lg:zoom-80 xl:zoom-85 2xl:zoom-85">
            {{ $slot }}
        </div>
    </main>
</body>

</html>