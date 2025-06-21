<x-app-layout>
    <div class="max-w-7xl mx-auto p-4">
         @include('components.toast')
        <h1 class="text-2xl font-bold text-gray-800">
            Selamat datang, {{ session('user')['username'] ?? 'User' }}!
        </h1>

        {{-- Tambahkan konten dashboard di sini --}}
    </div>
</x-app-layout>
