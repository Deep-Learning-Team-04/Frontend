<x-app-layout>
    {{-- Background --}}
    <style>
        body {
            background-color: #F9FAFB;
        }
    </style>

    {{-- Kontainer utama --}}
    <div class="w-full max-w-7xl px-6 mx-auto">
        <!-- Konten Halaman Home -->
        <div class="p-4 bg-[#F1F8FC] rounded-lg shadow-md border-t-8 border-[#7B9CD9]">
            <div class="flex flex-col items-center space-y-2 mt-8">
                <svg class="w-20 h-20 rounded-full bg-gray-200 text-gray-400 p-3" viewBox="0 0 24 24" fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z" />
                </svg>

                <span class="text-xl font-semibold">
                    {{ Auth::check() && !empty(Auth::user()->name) ? Auth::user()->name : 'User' }}
                </span>
            </div>


            <div class="mt-12">
                <!-- Nama -->
                <div class="mt-4">
                    <label for="nama" class="inline-block font-inter text-md font-medium text-neutral">
                        Nama
                    </label>
                    <x-text-input id="nama" class="block w-full" type="text" name="nama" placeholder="User"
                        :disabled="true" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <label for="email" class="inline-block font-inter text-md font-medium text-neutral">
                        Email
                    </label>
                    <x-text-input id="email" class="block w-full" type="text" name="email"
                        placeholder="User@gmail.com" :disabled="true" />
                </div>


                <!-- Riwayat Musik -->
                <div class="mt-4 pb-8">
                    <label for="riwayat" class="inline-block font-inter text-md font-medium text-neutral mb-2">
                        Riwayat Musik
                    </label>
                    <select id="riwayat" name="riwayat"
                        class="block w-full text-md font-inter rounded-md shadow-sm border border-gray-300 text-gray-500 bg-disabled placeholder:text-neutral">
                        <option value="tulus">Tulus</option>
                        <option value="raisa">Raisa</option>
                        <option value="pamungkas">Pamungkas</option>
                        <option value="nadin-amizah">Nadin Amizah</option>
                        <option value="hindia">Hindia</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
