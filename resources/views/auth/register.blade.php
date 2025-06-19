<x-guest-layout>
    <form method="GET" action="/register-success">
        <div class="flex flex-col items-center justify-center pt-16 pb-0">
            <h1 class="font-roboto text-4xl font-semibold text-[#232C43]">Registrasi</h1>
        </div>

        {{-- Nama --}}
        <div class="relative mt-4">
            <x-text-input id="name" class="block mt-1 w-full pr-12"
                          type="text" name="name" placeholder="Nama" required />

            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                <img src="{{ asset('img/user.png') }}" alt="Name Icon" class="w-6 h-6" />
            </div>
        </div>

        {{-- Email --}}
        <div class="relative mt-4">
            <x-text-input id="email" class="block mt-1 w-full pr-12"
                          type="email" name="email" placeholder="Email" required />

            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                <img src="{{ asset('img/gmail.png') }}" alt="Email Icon" class="w-6 h-6" />
            </div>
        </div>

        {{-- Password --}}
        <div class="relative mt-4">
            <x-text-input id="password" class="block mt-1 w-full pr-12"
                          type="password" name="password" placeholder="Kata sandi" required />

            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                <img src="{{ asset('img/password.png') }}" alt="Password Icon" class="w-6 h-6" />
            </div>
        </div>

        {{-- Konfirmasi --}}
        <div class="relative mt-4">
            <x-text-input id="password_confirmation" class="block mt-1 w-full pr-12"
                          type="password" name="password_confirmation"
                          placeholder="Konfirmasi kata sandi" required />

            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                <img src="{{ asset('img/password.png') }}" alt="Confirm Icon" class="w-6 h-6" />
            </div>
        </div>

        {{-- Tombol daftar --}}
        <div class="flex justify-center">
            <x-primary-button class="w-full text-lg py-2 mt-10">
                Registrasi
            </x-primary-button>
        </div>

        {{-- Link ke login --}}
        <p class="mt-2 text-center text-sm text-gray-600">
            Sudah punya akun?
            <a href="/login" class="text-primary hover:underline">Masuk sekarang</a>
        </p>
    </form>
</x-guest-layout>
