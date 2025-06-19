<nav
    class="bg-[#7B9CD9] shadow-[0_4px_16px_rgba(0,0,0,0.3)] h-16 flex items-center justify-between z-50 fixed top-0 inset-x-0 px-12">

    <!-- Kiri: Logo -->
    <div class="flex items-center">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-6 mr-2">
    </div>

    <!-- Avatar & Dropdown -->
    <div class="flex items-center space-x-2 text-white relative" x-data="{ open: false }">
        <span class="text-md font-medium">
            Halo, {{ Auth::check() && !empty(Auth::user()->name) ? Auth::user()->name : 'User' }}
        </span>

        <!-- Avatar SVG (klik untuk toggle logout) -->
        <svg @click="open = !open" class="w-8 h-8 rounded-full bg-gray-100 text-gray-300 p-2 cursor-pointer"
            viewBox="0 0 24 24" fill="currentColor">
            <path
                d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
        </svg>

        <!-- Dropdown Menu: Log Out -->
        <div x-show="open" x-transition @click.away="open = false"
            class="absolute right-0 mt-24 w-32 bg-white border-[#F83B3E] rounded-md shadow-lg py-1 z-50">
            {{-- <form method="POST" action="{{ route('logout') }}"> --}}
                @csrf
                <button type="submit"
                    class="flex items-center w-full text-left px-4 py-2 text-sm font-medium text-[#F83B3E] hover:bg-[#ffecec]">
                    <!-- Ikon Logout -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 stroke-[#F83B3E]" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                    </svg>

                    <!-- Teks -->
                    <span class="ml-2">Keluar</span>
                </button>
            </form>
        </div>
    </div>
</nav>
