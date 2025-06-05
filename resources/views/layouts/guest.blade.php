<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-inter text-gray-900 antialiased">
    <div class="flex justify-center items-center min-h-screen bg-[#F1F8FC]">
        <div style="background-color: #E5F1FA; width: 736px; padding: 80px 200px;" class="shadow-md rounded-lg">
            <!-- Logo -->
            <div class="flex justify-center">
                <a href="/">
                    <img src="img/logo auth.png" alt="footer" />
                </a>
            </div>

            <!-- Konten Form -->
            {{ $slot }}
        </div>
    </div>

</body>

</html>
