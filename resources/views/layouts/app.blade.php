<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-[#FDFDFD]">

        {{-- Top Navigation --}}
        @include('layouts.navigation')

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        <!-- Page Content -->
        <main class="pl-64 pr-4 pt-28">
            {{ $slot }}
        </main>
    </div>
</body>
