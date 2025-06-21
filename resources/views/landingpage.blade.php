<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>
        Deep Music
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body class="bg-[#F1F8FC] text-[#2f3e5e] ">

    <!-- Navbar -->
    <nav class="bg-[#7B9CD9] flex justify-between items-center px-[72px] h-[64px]">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="h-8">
        </div>

        <div class="space-x-2">
            <a href="/register">
                <x-border-button class="w-[75px] h-[36px]">
                    Daftar
                </x-border-button>
            </a>
            <a href="/login">
                <x-secondary-button class="w-[75px] h-[36px]">
                    Masuk
                </x-secondary-button>
            </a>
        </div>

    </nav>

    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-6 h-[600px] flex flex-col-reverse md:flex-row items-center">
        <!--Teks -->
        <div class="md:w-1/2 flex justify-center md:justify-start">
            <div class="text-center md:text-left flex flex-col justify-center h-full">
                <h1 class="font-roboto text-4xl font-extrabold text-[#4a63b1] drop-shadow-lg mb-10">Selamat Datang di
                    Deep Music!</h1>
                <h2 class="font-roboto text-3xl font-semibold text-[#7B9CD9] mb-1">Atur personalisasi musik <br />
                    sesuai yang anda inginkan.</h2>
                <p class="font-inter text-2xl text-[#6E7971] mb-20">Temukan musik yang anda sukai hari ini! Pilih
                    playlist yang kami sediakan atau dapatkan rekomendasi
                    musik sesuai personalisasi anda</p>
                <div class="flex justify-center md:justify-start">
                   <a href="/login" class="bg-[#5a6ebf] text-white font-semibold text-[14px] md:text-[16px] rounded px-5 py-3 hover:bg-[#4a5dbf] transition">
                    Coba sekarang
                    </a>
                </div>
            </div>
        </div>
        <!-- Gambar -->
        <div class="md:w-1/2 mb-12 md:mb-0" style="transform: translate(50px, 58px);">
            <img src="img/hero.png"
                class="w-auto max-h-[700px] object-contain transform translate-x-[60px] -translate-y-[30px]"
                alt="Hero" />
        </div>
    </div>

    <!-- Features Section -->
    <section class="relative bg-[#F1F8FC] pt-12 pb-40 mt-[70px]">
        <!-- Persegi panjang-->
        <div class="absolute top-0 left-0 w-full h-[400px] bg-[#7B9CD9] z-0"></div>

        <!-- OVAL-->
        <div class="absolute top-[180px] left-1/2 -translate-x-1/2 w-full h-[420px] bg-[#7B9CD9] z-0"
            style="border-radius: 90% / 100%;"></div>

        <!-- Konten-->
        <div class="relative z-10 pt-32">
            <h1 class="font-roboto text-4xl font-bold text-white text-center mb-10">Fitur Deep music</h1>
            <div
                class="bg-white rounded-md shadow-xl max-w-5xl mx-auto p-6 grid grid-cols-1 sm:grid-cols-2 gap-8 text-center py-24 border-t-8 border-[#B4D1ED]">
                <div class="text-center">
                    <img src="img/search.png" class="mb-2 mx-auto" alt="ikon" />
                    <h3 class="font-inter text-xl text-[#7B9CD9] font-bold mb-5 select-none">
                        Pencarian Musik
                    </h3>
                    <p class="font-inter text-sm text-[#4a5a8a] max-w-[300px] mx-auto mb-8">
                        Temukan lagu favoritmu dengan mudah berdasarkan judul lagu dan artis.
                    </p>
                </div>
                <div class="text-center">
                    <img src="img/user_landing.png" class="mb-2 mx-auto" alt="ikon" />
                    <h3 class="font-inter text-xl text-[#7B9CD9] font-bold mb-5 select-none">
                        Personalisasi Musik
                    </h3>
                    <p class="font-inter text-sm text-[#4a5a8a] max-w-[300px] mx-auto mb-8">
                        Sistem kami mempelajari preferensimu dari umpan balik dan kebiasaan mendengarkan.
                    </p>
                </div>
                <div class="text-center">
                    <img src="img/music.png" class="mb-2 mx-auto" alt="ikon" />
                    <h3 class="font-inter text-xl text-[#7B9CD9] font-bold mb-5 select-none">
                        Manajemen Musik
                    </h3>
                    <p class="font-inter text-sm text-[#4a5a8a] max-w-[300px] mx-auto">
                        Kelola daftar putar (playlist) dan histori musikmu dengan mudah.
                    </p>
                </div>
                <div class="text-center">
                    <img src="img/recommend.png" class="mb-2 mx-auto" alt="ikon" />
                    <h3 class="font-inter text-xl text-[#7B9CD9] font-bold mb-5 select-none">
                        Rekomendasi Musik
                    </h3>
                    <p class="font-inter text-sm text-[#4a5a8a] max-w-[300px] mx-auto">
                        Dapatkan rekomendasi lagu yang sesuai dengan suasana hatimu.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="w-full bg-[#B4D1ED] py-10 px-[240px]">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between border-b border-[#ADB5AF] pb-3">
                <div class="flex items-center space-x-3">
                     <img src="img/logo footer.png" class="mb-2 mx-auto" alt="footer" />
                </div>
            </div>
            <div class="flex justify-between text-[#6E7971] font-inter text-base text-sm mt-4 select-none">
                <p class="font-inter text-base">© 2025 All rights reserved.</p>
                <p class="font-inter text-base">Managed by Kelompok 4</p>
            </div>
        </div>
    </footer>


</body>

</html>
