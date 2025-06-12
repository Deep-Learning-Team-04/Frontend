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
            
            <!-- Form -->
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- File Audio -->
                <div class="mt-8">
                    <label for="audio" class="block text-md font-medium text-neutral mb-2">
                        File Audio
                    </label>
                    <input type="file" id="audio" name="audio" class="block w-full text-sm shadow-sm" required />
                </div>

                <!-- Genre -->
                <div class="mt-4">
                    <label for="genre" class="inline-block font-inter text-md font-medium text-neutral">
                        Genre
                    </label>
                    <x-text-input id="genre" class="block w-full pr-12" type="text" name="genre"
                        placeholder="Tambahkan genre lagu" :disabled="false" required />
                </div>

                <!-- Nama Lagu -->
                <div class="mt-4">
                    <label for="nama_lagu" class="inline-block font-inter text-md font-medium text-neutral">
                        Nama Lagu
                    </label>
                    <x-text-input id="nama_lagu" class="block w-full pr-12" type="text" name="nama_lagu"
                        placeholder="Tambahkan nama lagu" :disabled="false" required />
                </div>

                <!-- Artis -->
                <div class="mt-4">
                    <label for="artis" class="inline-block font-inter text-md font-medium text-neutral mb-2">
                        Artis
                    </label>
                    <select id="artis" name="artis" required
                        class="block w-full text-md rounded-md shadow-sm border border-gray-300 text-neu900 placeholder:text-gray-400 focus:outline-none focus:border-[#7B9CD9] focus:ring-1 focus:ring-[#7B9CD9]">
                        <option value="" disabled selected>-- Pilih Artis --</option>
                        <option value="tulus">Tulus</option>
                        <option value="raisa">Raisa</option>
                        <option value="pamungkas">Pamungkas</option>
                        <option value="nadin-amizah">Nadin Amizah</option>
                        <option value="hindia">Hindia</option>
                    </select>
                </div>

                <!-- Tombol Kirim -->
                <div class="flex justify-center mt-8 pb-20">
                    <x-primary-button type="submit"
                        class="flex items-center justify-center gap-2 w-[240px] h-[40px] text-md py-2 mt-10">
                        <img src="img/save.png" alt="Icon" style="max-width: 24px; max-height: 24px;" />
                        {{ __('Kirim') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
