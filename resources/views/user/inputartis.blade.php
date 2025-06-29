<x-app-layout>
    {{-- Background --}}
    <style>
        body {
            background-color: #F9FAFB;
        }
    </style>

    {{-- Kontainer utama --}}
    <div class="w-full max-w-7xl px-6 mx-auto">
        <div class="p-4 bg-[#F1F8FC] rounded-lg shadow-md border-t-8 border-[#7B9CD9]">

            <form id="uploadArtistForm" enctype="multipart/form-data">
                @csrf

                <div class="mt-8">
                    <label for="foto" class="block text-md font-medium text-neutral mb-2">
                        Upload Foto
                    </label>
                    <input type="file" id="foto" name="image" class="block w-full text-sm shadow-sm" accept="image/*"/>
                </div>

                <div class="mt-4">
                    <label for="artis" class="inline-block font-inter text-md font-medium text-neutral">
                        Nama Artis
                    </label>
                    <x-text-input id="artis" class="block w-full pr-12" type="text" name="name"
                        placeholder="Tambahkan nama artis" :disabled="false" required />
                </div>
                
                <div id="uploadStatus" class="mt-4 text-center font-medium"></div>

                <div class="flex justify-center mt-8 pb-20">
                    <x-primary-button type="submit"
                        class="flex items-center justify-center gap-2 w-[240px] h-[40px] text-md py-2 mt-10">
                        <img src="{{ asset('img/save.png') }}" alt="Icon" style="max-width: 24px; max-height: 24px;" />
                        {{ __('Kirim') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script untuk handle input artis --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('uploadArtistForm');
            const statusDiv = document.getElementById('uploadStatus');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah halaman reload

                statusDiv.textContent = 'Mengunggah...';
                statusDiv.style.color = 'blue';

                const formData = new FormData(form);
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch("{{ route('upload.store') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: formData,
                })

                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw err; });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'success') {
                        statusDiv.textContent = 'Sukses: Artis berhasil ditambahkan!'; 
                        statusDiv.style.color = 'green';
                        form.reset();
                    } else {
                        // Jika status bukan 'success' = error
                        statusDiv.textContent = 'Error: ' + (data.message || 'Gagal menambahkan artis.'); // menampilkan error dari server
                        statusDiv.style.color = 'red';
                    }
                })
                .catch(error => {
                    console.error('Terjadi kesalahan:', error);
                    // Menampilkan pesan error dari server jika ada, atau pesan default
                    const errorMessage = error.message || 'Terjadi kesalahan jaringan. Silakan coba lagi.';
                    statusDiv.textContent = 'Error: ' + errorMessage;
                    statusDiv.style.color = 'red';
                });
            });
        });
    </script>
</x-app-layout>