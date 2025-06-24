<nav
    class="bg-[#7B9CD9] shadow-[0_4px_16px_rgba(0,0,0,0.3)] h-16 flex items-center justify-between z-50 fixed top-0 inset-x-0 px-12">
    <!-- Kiri: Logo dan Search Bar -->
    <div class="flex items-center space-x-6">
        <!-- Logo -->
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-6 mr-2">

        <!-- Tombol Home -->
        <a href="{{ route('user.home') }}">
            <div
                class="bg-white rounded-full p-2 flex items-center justify-center border-2 border-transparent hover:border-[#516ab1] hover:shadow-lg transition duration-200">
                <img src="{{ asset('img/home.png') }}" alt="Home" class="w-6 h-6" />
            </div>
        </a>

        <!-- Search Bar -->
        <div class="relative w-[500px]">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <img src="{{ asset('img/search.png') }}" alt="search" class="w-6 h-6" />
            </div>
            <input type="text" placeholder="Cari judul lagu dan artis"
                class="pl-12 pr-4 py-[6px] w-full rounded bg-white border-2 border-[#EBEDEC] placeholder:text-[#ADB5AF] focus:outline-none focus:ring-2 focus:ring-primary text-sm transition"
                x-model="searchQuery" />
        </div>
    </div>

    <!-- Kanan: Avatar & Dropdown -->
    <div class="flex items-center space-x-2 text-white relative" x-data="{ open: false }">
        <span class="text-md font-medium">
            Halo, {{ session('user')['username'] ?? 'User' }}
        </span>

        <!-- Avatar SVG (klik untuk toggle logout) -->
        <svg @click="open = !open" class="w-8 h-8 rounded-full bg-gray-100 text-gray-300 p-2 cursor-pointer"
            viewBox="0 0 24 24" fill="currentColor">
            <path
                d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
        </svg>

        <!-- Dropdown Menu -->
        <div x-cloak x-show="open" x-transition @click.away="open = false"
            class="absolute right-0 mt-36 w-48 bg-white border-[#F83B3E] rounded-md shadow-lg py-1 z-50">

            <!-- Tombol Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <!-- Link Profile -->
                <a href="{{ route('user.profile') }}"
                    class="flex items-center w-full text-left px-4 py-2 text-sm font-medium text-primary hover:bg-[#f1f8fc]">
                    <img src="{{ asset('img/profile.png') }}" alt="Home" class="w-4 h-4" />
                    <span class="ml-2">Profile</span>
                </a>
                <button type="submit"
                    class="flex items-center w-full text-left px-4 py-2 text-sm font-medium text-[#F83B3E] hover:bg-[#ffecec]">
                    <img src="{{ asset('img/logout.png') }}" alt="Home" class="w-4 h-4" />
                    <span class="ml-2">Keluar</span>
                </button>
            </form>
        </div>
    </div>

</nav>
