<x-app-layout>
    <style>
        body { background-color: #F9FAFB; }
        [x-cloak] { display: none !important; }
    </style>

    <div class="w-full max-w-7xl px-6 mx-auto" x-data="{ liked: false }">
        <div id="playlist-content" class="flex gap-2 opacity-0 transition-opacity duration-500">
            <div class="flex flex-col items-center w-1/3">
                <div id="playlist-image-container" class="bg-[#D0E4F5] w-60 h-60 flex items-center justify-center rounded">
                    <img src="{{ asset('img/playlist.png') }}" alt="playlist" class="w-20 h-20" />
                </div>
                <h2 id="playlist-name" class="font-roboto text-[24px] font-semibold text-neu900 mt-4 text-center">Memuat...</h2>
                <p id="playlist-description" class="font-inter text-[16px] font-medium text-[#adb5af] mb-8 text-center"></p>
                <p id="playlist-stats" class="font-inter text-[14px] font-medium text-primary"></p>
            </div>

            <div class="flex-1">
                <div class="flex items-center px-4 py-4 border-b border-gray-200">
                    <div class="flex-1 font-inter text-[14px] font-medium text-neu900">Judul</div>
                    <div class="w-32 text-center font-inter text-[14px] font-medium text-neu900">Artis</div>
                    <div class="w-24 text-center font-inter text-[14px] font-medium text-neu900">Genre</div>
                </div>

                <div id="song-list-container">
                    <p class="text-center text-gray-500 p-4">Memuat lagu...</p>
                </div>
            </div>
        </div>
        <div id="playlist-error" class="text-center text-red-500 p-8 hidden"></div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        async function fetchPlaylistDetails() {
            const container = document.getElementById('playlist-content');
            const errorDiv = document.getElementById('playlist-error');
            const songListContainer = document.getElementById('song-list-container');
            
            // Mengambil ID playlist dari URL
            const urlParts = window.location.pathname.split('/');
            const playlistId = urlParts[urlParts.length - 1];

            if (!playlistId) {
                showError('ID Playlist tidak ditemukan di URL.');
                return;
            }

            // Endpoint API yang benar berdasarkan gambar Anda
            const apiUrl = `https://57a4-2001-448a-5001-20d3-556c-7f5c-5957-8be4.ngrok-free.app/playlists/list`;

            try {
                const response = await fetch(apiUrl, {
                    headers: {
                        'Accept': 'application/json',
                        'ngrok-skip-browser-warning': 'true' // Header khusus untuk ngrok
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const playlists = await response.json();
                
                // Debug: Lihat response di console
                console.log('API Response:', playlists);
                
                // Cari playlist dengan ID yang sesuai
                const playlist = playlists.find(p => p.id === playlistId);
                
                if (!playlist) {
                    throw new Error('Playlist tidak ditemukan');
                }

                // Update UI dengan data playlist
                updatePlaylistUI(playlist);
                
                // Tampilkan konten setelah data dimuat
                container.classList.remove('opacity-0');

            } catch (error) {
                console.error('Error fetching playlist:', error);
                showError(`Gagal memuat playlist: ${error.message}`);
            }
        }

        function updatePlaylistUI(playlist) {
            document.getElementById('playlist-name').textContent = playlist.name || 'Nama Playlist';
            document.getElementById('playlist-description').textContent = playlist.description || 'Tidak ada deskripsi';
            document.getElementById('playlist-stats').textContent = `${playlist.song_count || 0} lagu`;
            
            const songListContainer = document.getElementById('song-list-container');
            songListContainer.innerHTML = '';
            
            if (playlist.songs && playlist.songs.length > 0) {
                playlist.songs.forEach(song => {
                    const songElement = document.createElement('div');
                    songElement.className = 'flex items-center bg-[#F1F8FC] rounded-md px-4 py-2 mb-3 hover:bg-[#E5F1FA] transition';
                    songElement.innerHTML = `
                        <img class="w-12 h-12 rounded-md object-cover" src="{{ asset('img/hero.png') }}" alt="Foto lagu" />
                        <div class="ml-3 flex-1 min-w-0">
                            <p class="font-inter text-[16px] font-semibold text-neu900 truncate">${song.song_name || 'Judul Lagu'}</p>
                        </div>
                        <div class="w-32 text-center truncate font-inter text-[14px] text-gray-600">${song.artist_name || 'N/A'}</div>
                        <div class="w-24 text-center truncate font-inter text-[14px] text-gray-600">${song.genre || 'N/A'}</div>
                    `;
                    songListContainer.appendChild(songElement);
                });
            } else {
                songListContainer.innerHTML = '<p class="text-center text-gray-500 p-4">Playlist ini belum memiliki lagu.</p>';
            }
        }

        function showError(message) {
            const errorDiv = document.getElementById('playlist-error');
            const container = document.getElementById('playlist-content');
            
            errorDiv.textContent = message;
            errorDiv.classList.remove('hidden');
            container.classList.add('hidden');
            
            // Tambahkan tombol coba lagi
            const retryButton = document.createElement('button');
            retryButton.textContent = 'Coba Lagi';
            retryButton.className = 'mt-2 px-4 py-2 bg-primary text-white rounded hover:bg-primary-dark transition';
            retryButton.onclick = fetchPlaylistDetails;
            errorDiv.appendChild(retryButton);
        }

        // Panggil fungsi saat halaman dimuat
        fetchPlaylistDetails();
    });
    </script>

</x-app-layout>

