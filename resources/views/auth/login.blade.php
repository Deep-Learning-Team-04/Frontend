<x-guest-layout>
    @include('components.toast')
    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <div class="flex flex-col items-center justify-center pt-16 pb-0">
            <h1 class="font-roboto text-4xl font-semibold text-[#232C43]">Masuk</h1>
        </div>

        <!-- Toast Notification -->
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    showToast("{{ session('success') }}", 'success');
                });
            </script>
        @elseif(session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    showToast("{{ session('error') }}", 'error');
                });
            </script>
        @endif

        {{-- Email --}}
        <div class="mt-4 relative">
            <div class="relative">
                <x-text-input id="email" class="block mt-1 w-full pr-12" type="email" name="email"
                    autocomplete="email" placeholder="Email" value="{{ old('email') }}" required autofocus />
                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                    <img src="{{ asset('img/gmail.png') }}" alt="Icon" class="w-6 h-6" />
                </div>
            </div>
            @error('email')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mt-4 relative">
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-12" type="password" name="password"
                    autocomplete="current-password" placeholder="Kata sandi" required />
                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                    <img src="{{ asset('img/password.png') }}" alt="Icon" class="w-6 h-6" />
                </div>
            </div>
            @error('password')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center justify-between mt-2">
            <div class="block">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-[#7B9CD9] shadow-sm focus:ring-[#7B9CD9]" name="remember">
                    <span class="ms-2 text-sm text-gray-700">Ingat saya</span>
                </label>
            </div>
        </div>

        {{-- Button Masuk --}}
        <div class="flex justify-center">
            <x-primary-button class="w-full text-lg py-2 mt-10">
                Masuk
            </x-primary-button>
        </div>

        {{-- Link ke Register --}}
        <p class="mt-2 text-center text-sm text-gray-600">
            Tidak punya akun?
            <a href="{{ route('register') }}" class="text-primary hover:underline">Registrasi sekarang</a>
        </p>
    </form>
</x-guest-layout>
