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

            <form id="uploadSongForm" enctype="multipart/form-data">
                @csrf

                {{-- Upload File Audio --}}
                <div class="mt-8">
                    <label for="audio" class="block text-md font-medium text-neutral mb-2">File Audio</label>
                    <input type="file" id="audio" name="file" class="block w-full text-sm shadow-sm" required accept=".mp3,.wav,.mpeg" />
                </div>

                {{-- Genre --}}
                <div class="mt-4">
                    <label for="genre" class="inline-block font-inter text-md font-medium text-neutral">Genre</label>
                    <x-text-input id="genre" class="block w-full pr-12" type="text" name="genre" placeholder="Tambahkan genre lagu" required />
                </div>

                {{-- Nama Lagu --}}
                <div class="mt-4">
                    <label for="nama_lagu" class="inline-block font-inter text-md font-medium text-neutral">Nama Lagu</label>
                    <x-text-input id="nama_lagu" class="block w-full pr-12" type="text" name="song_name" placeholder="Tambahkan nama lagu" required />
                </div>

                {{-- Dropdown Artis --}}
                <div class="mt-4">
                    <label for="artis" class="inline-block font-inter text-md font-medium text-neutral mb-2">Artis</label>
                    <x-select-input id="artis" name="artist_id" required
                        class="block w-full text-md rounded-md shadow-sm border border-gray-300 text-neu900 placeholder:text-gray-400 focus:outline-none focus:border-[#7B9CD9] focus:ring-1 focus:ring-[#7B9CD9]">
                        <option value="" disabled selected>-- Pilih Artis --</option>
                    </x-select-input>
                </div>

                <div id="uploadStatus" class="mt-4 text-center font-medium"></div>

                <div class="flex justify-center mt-8 pb-20">
                    <x-primary-button type="submit" class="flex items-center justify-center gap-2 w-[240px] h-[40px] text-md py-2 mt-10">
                        <img src="{{ asset('img/save.png') }}" alt="Icon" style="max-width: 24px; max-height: 24px;" />
                        {{ __('Kirim') }}
                    </x-primary-button>
                </div>
            </form>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const artistSelect = document.getElementById('artis');
            const form = document.getElementById('uploadSongForm');
            const statusDiv = document.getElementById('uploadStatus');

            async function fetchAndDisplayArtists() {
                artistSelect.innerHTML = '<option value="" disabled selected>-- Memuat artis... --</option>';

                try {
                    const bearerToken = "{{ session('token') }}"; // Ambil token dari session Laravel

                    if (!bearerToken) {
                        console.error('Bearer token kosong');
                        artistSelect.innerHTML = '<option value="" disabled selected>-- Harap login terlebih dahulu --</option>';
                        return;
                    }

                    const response = await fetch('https://57a4-2001-448a-5001-20d3-556c-7f5c-5957-8be4.ngrok-free.app/artists/', {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json',
                            'Authorization': `Bearer ${bearerToken}`,
                            'ngrok-skip-browser-warning': 'true' // Untuk menghindari warning dari ngrok
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`Gagal memuat artis. Status: ${response.status}`);
                    }

                    const data = await response.json();
                    
                    // Pastikan data yang diterima adalah array
                    if (!Array.isArray(data)) {
                        throw new Error('Format data artis tidak valid');
                    }

                    artistSelect.innerHTML = '<option value="" disabled selected>-- Pilih Artis --</option>';

                    data.forEach(artist => {
                        const option = document.createElement('option');
                        option.value = artist.id;
                        option.textContent = artist.name;
                        artistSelect.appendChild(option);
                    });

                } catch (error) {
                    console.error('Error:', error);
                    artistSelect.innerHTML = `<option value="" disabled selected>-- Gagal memuat artis: ${error.message} --</option>`;
                }
            }

            fetchAndDisplayArtists();

            // === Submit Form Upload Lagu ===
            form.addEventListener('submit', async function(event) {
                event.preventDefault();
                statusDiv.textContent = 'Mengunggah lagu...';
                statusDiv.style.color = 'blue';

                try {
                    const formData = new FormData(form);
                    const bearerToken = "{{ session('token') }}";
                    
                    // Tambahkan timeout controller
                    const controller = new AbortController();
                    const timeoutId = setTimeout(() => controller.abort(), 60000); // 60 detik timeout

                    const response = await fetch('https://57a4-2001-448a-5001-20d3-556c-7f5c-5957-8be4.ngrok-free.app/songs/upload', {
                        method: 'POST',
                        headers: {
                            'Authorization': `Bearer ${bearerToken}`,
                            'Accept': 'application/json',
                            'ngrok-skip-browser-warning': 'true'
                        },
                        body: formData,
                        signal: controller.signal
                    });

                    clearTimeout(timeoutId);

                    if (!response.ok) {
                        const errorData = await response.json();
                        throw new Error(errorData.message || 'Upload gagal');
                    }

                    const data = await response.json();
                    statusDiv.textContent = 'Berhasil: ' + (data.message || 'Lagu berhasil diunggah');
                    statusDiv.style.color = 'blue';
                    form.reset();
                } catch (error) {
                    console.error('Upload Error:', error);
                    statusDiv.textContent = 'Error: ' + (error.message || 'Gagal mengunggah lagu');
                    statusDiv.style.color = 'red';
                }
            });
            });
    </script>
</x-app-layout>