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
    <main class="relative z-10 h-screen flex flex-col justify-end">
        {{ $slot }}
    </main>
</body>

</html>