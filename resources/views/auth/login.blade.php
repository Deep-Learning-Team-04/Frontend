<x-guest-layout>
<<<<<<< HEAD
    <form method="GET" action="/dashboard">
        <div class="flex flex-col items-center justify-center pt-16 pb-0">
            <h1 class="font-roboto text-4xl font-semibold text-[#232C43]">Masuk</h1>
        </div>

        <div class="mt-4 relative">
            <div class="relative">
                <x-text-input id="email" class="block mt-1 w-full pr-12" type="email" name="email"
                    placeholder="Email" required autofocus />
                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                    <img src="img/gmail.png" alt="Icon" style="max-width: 24px; max-height: 24px;" />
                </div>
            </div>
        </div>

        <div class="mt-4 relative">
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-12" type="password" name="password"
                    placeholder="Kata sandi" required />
                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                    <img src="img/password.png" alt="Icon" style="max-width: 24px; max-height: 24px;" />
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between mt-2">
            <div class="block">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-[#7B9CD9] shadow-sm focus:ring-[#7B9CD9]" name="remember">
                    <span class="ms-2 text-sm text-gray-700">Ingat saya</span>
                </label>
            </div>
        </div>

        <div class="flex justify-center">
            <x-primary-button class="w-full text-lg py-2 mt-10">
                Masuk
            </x-primary-button>
        </div>

        <p class="mt-2 text-center text-sm text-gray-600">
            Tidak punya akun?
            <a href="/register" class="text-primary hover:underline">Registrasi sekarang</a>
=======
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="flex flex-col items-center justify-center pt-16 pb-0">
            <h1 class="font-roboto text-4xl font-semibold text-[#232C43]">Masuk</h1>
        </div>

        <!-- Email Address -->
        <div class="mt-4 relative">
            <div class="relative">
            <x-text-input id="email" class="block mt-1 w-full pr-12" type="email" name="email" :value="old('email')"
                placeholder="Email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />

            <!-- Ikon kanan -->
            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                <img src="img/gmail.png" alt="Icon" style="max-width: 24px; max-height: 24px;" />
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4 relative">
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-12" type="password" name="password"
                    placeholder="Kata sandi" required autocomplete="current-password" />
            </div>

            <!-- Ikon kanan -->
            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                <img src="img/password.png" alt="Icon" style="max-width: 24px; max-height: 24px;" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-2">
            <!-- Remember Me -->
            <div class="block">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-[#7B9CD9] shadow-sm focus:ring-[#7B9CD9]" name="remember">
                    <span class="ms-2 text-sm text-gray-700">{{ __('Ingat saya') }}</span>
                </label>
            </div>
        </div>


        {{-- Tombol Login --}}
        <div class="flex justify-center">
            <x-primary-button class="w-full text-lg py-2 mt-10">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>


        {{-- Link ke Registrasi --}}
        <p class="mt-2 text-center text-sm text-gray-600">
            Tidak punya akun?
            <a href="{{ route('register') }}" class="text-primary hover:underline">Registrasi sekarang</a>
>>>>>>> 42f124953f68747f285d1fc2c93f70db54c8000c
        </p>
    </form>
</x-guest-layout>

