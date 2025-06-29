<x-app-layout>
    <style>
        body { background-color: #F9FAFB; }
        [x-cloak] { display: none !important; }
    </style>

    <div class="w-full max-w-7xl px-6 mx-auto" x-data="{ liked: false }">
        <div id="playlist-content" class="flex gap-2 opacity-0 transition-opacity duration-500">
            <!-- Sisi Kiri - Informasi Playlist -->
            <div class="flex flex-col items-center w-1/3">
                <div id="playlist-image-container" class="relative bg-[#D0E4F5] w-60 h-60 flex items-center justify-center rounded-lg shadow-md">
                    <img src="{{ asset('img/playlist.png') }}" alt="playlist" class="w-full h-full object-cover rounded-lg" />
                    <button @click="liked = !liked" :class="liked ? 'text-[#f83b3e]' : 'text-white'"
                        class="absolute bottom-3 right-3 w-8 h-8 hover:text-[#f83b3e] transition-colors" title="Favorite">
                        <svg fill="currentColor" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>
                </div>
                <h2 id="playlist-name" class="font-roboto text-[24px] font-semibold text-neu900 mt-4 text-center">Memuat...</h2>
                <p id="playlist-description" class="font-inter text-[16px] font-medium text-[#adb5af] mb-2 text-center"></p>
                <p id="playlist-stats" class="font-inter text-[14px] font-medium text-primary"></p>
            </div>

            <!-- Sisi Kanan - Daftar Lagu -->
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

            const apiUrl = `https://57a4-2001-448a-5001-20d3-556c-7f5c-5957-8be4.ngrok-free.app/playlists/list`;

            try {
                const response = await fetch(apiUrl, {
                    headers: {
                        'Accept': 'application/json',
                        'ngrok-skip-browser-warning': 'true'
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const playlists = await response.json();
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
                        <div class="flex items-center flex-1 min-w-0">
                            <div class="ml-3 flex-1 min-w-0">
                                <p class="font-inter text-[16px] font-semibold text-neu900 truncate">${song.song_name || 'Judul Lagu'}</p>
                            </div>
                            <div class="w-32 text-center truncate font-inter text-[14px] text-gray-600">${song.artist_name || 'N/A'}</div>
                            <div class="w-24 text-center truncate font-inter text-[14px] text-gray-600">${song.genre || 'N/A'}</div>
                        </div>
                        <div class="flex items-center gap-2 ml-4">
                            <button class="w-4 h-4 text-[#adb5af] hover:text-primary" title="Tambah ke playlist">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                            <button class="w-5 h-5 text-[#adb5af] hover:text-[#f83b3e]" title="Favorite">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
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
