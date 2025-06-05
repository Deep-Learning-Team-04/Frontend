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

            <!-- Konten -->
            <div class="mt-8">
                <label for="foto" class="block text-md font-medium text-neutral mb-2">
                    Uplod Foto
                </label>
                <input type="file" id="foto" name="foto" class="block w-full text-sm shadow-sm" />
            </div>

            <div class="mt-4">
                <label for="artis" class="inline-block font-inter text-md font-medium text-neutral">
                    Nama artis
                </label>
                <x-text-input id="artis" class="block  w-full pr-12" type="text" name="artis" placeholder="Tambahkan nama artis" required />
            </div>

            <!-- Tombol Kirim -->
            <div class="flex justify-center mt-8 pb-20">
               <x-primary-button type="submit" class="flex items-center justify-center gap-2 w-[240px] h-[40px] text-md py-2 mt-10">
                    <img src="img/save.png" alt="Icon" style="max-width: 24px; max-height: 24px;" />
                    {{ __('Kirim') }}
                </x-primary-button>
            </div>
        </div>
    </div>
</x-app-layout>
