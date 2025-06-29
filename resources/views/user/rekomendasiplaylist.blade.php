<x-app-layout>
    {{-- Background --}}
    <style>
        body {
            background-color: #F9FAFB;
        }
    </style>

    {{-- Kontainer utama --}}
    <div class="w-full px-6 mx-auto max-w-7xl" x-data="{
        result: null,
        liked: false,
        open: false,
        openModal: false,
        selected: [],
        playlists: ['Calm', 'Focus']
    }">
        <div class="w-full px-6 mx-auto max-w-7xl">

            <!-- Modal playlist tersimpan -->
            <div x-cloak x-show="$store.modalStore.open"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-[#f1f8fc] border-2 border-primary rounded-lg p-10 w-[400px]">
                    <!-- Header dan Search -->
                    <div class="flex items-center mb-6">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <img src="img/search.png" alt="search" class="w-4 h-4" />
                            </div>
                            <input type="text" placeholder="Cari Playlist"
                                class="pl-10 pr-3 py-2 w-full rounded bg-white border-2 border-[#EBEDEC] placeholder:text-[#ADB5AF] focus:outline-none focus:ring-2 focus:ring-primary text-sm transition"
                                x-model="$store.modalStore.searchQuery" />
                        </div>
                        <button @click="$store.modalStore.open = false; $store.modalStore.openCreateModal = true"
                            class="ml-2 p-2 bg-white border border-primary rounded text-primary hover:bg-[#f1f8fc] text-xl leading-none">
                            +
                        </button>
                    </div>

                    <h2 class="text-[18px] font-medium text-[#8F9992] mb-0">Playlist tersimpan</h2>

                    <!-- Daftar Playlist -->
                    <template x-for="playlist in $store.modalStore.filteredPlaylists" :key="playlist.id">
                        <div @click="$store.modalStore.selectPlaylist(playlist.id)"
                            class="flex items-center justify-between p-2 rounded hover:bg-[#f1f8fc] cursor-pointer transition"
                            :class="{ 'bg-[#e1f0ff]': $store.modalStore.isSelected(playlist.id) }">
                            <div class="flex items-center gap-3">
                                <div class="bg-[#D0E4F5] w-10 h-10 rounded flex items-center justify-center">
                                    <img src="img/playlist.png" alt="playlist" class="w-[20px] h-[20px]" />
                                </div>
                                <div>
                                    <p class="text-[14px] font-medium text-neu900" x-text="playlist.name"></p>
                                    <p class="text-[12px] font-medium text-[#ADB5AF]"
                                        x-text="`${playlist.song_count || 0} lagu`"></p>
                                </div>
                            </div>
                            <div class="w-5 h-5 rounded-xl border-2 border-[#516ab1] flex items-center justify-center">
                                <div class="w-2 h-2 rounded bg-primary"
                                    x-show="$store.modalStore.isSelected(playlist.id)"></div>
                            </div>
                        </div>
                    </template>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-between mt-4">
                        <x-secondary-button @click="$store.modalStore.resetModal()" class="w-[150px] h-[36px]">
                            Kembali
                        </x-secondary-button>
                        <x-primary-button @click="$store.modalStore.saveSelection()" class="w-[150px] h-[36px]">
                            Simpan
                        </x-primary-button>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Playlist -->
            <div x-cloak x-show="$store.modalStore.openCreateModal"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <form method="POST" action="{{ route('playlist.store') }}">
                    <div
                        class="bg-[#f1f8fc] border-2 border-primary rounded-md shadow-lg p-10 relative w-[600px] h-[320px]">
                        @csrf
                        <button @click="$store.modalStore.openCreateModal = false"
                            class="absolute flex items-center justify-center w-6 h-6 text-xl bg-gray-200 rounded-full top-2 right-3 text-neu900 hover:text-neu900 hover:bg-gray-300">
                            &times;
                        </button>
                        <h2 class="text-[18px] font-medium text-[#8F9992] mb-4">Tambah Playlist</h2>
                        <div class="flex gap-2">
                            <div class="bg-[#D0E4F5] w-[144px] h-[144px] rounded flex items-center justify-center">
                                <img src="img/playlist.png" alt="playlist" class="w-[84px] h-[84px]" />
                            </div>
                            <div class="flex flex-col flex-1 gap-3">
                                <input name="name" type="text" placeholder="Nama playlist"
                                    value="{{ old('name') }}"
                                    class="p-2 rounded bg-[#EBEDEC] placeholder:text-[#ADB5AF] text-sm focus:outline-none focus:ring-2 focus:ring-primary transition"
                                    required />
                                @error('name')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror

                                <textarea name="description" placeholder="Tambahkan deskripsi (opsional)"
                                    class="p-2 rounded bg-[#EBEDEC] placeholder:text-[#ADB5AF] text-sm focus:outline-none focus:ring-2 focus:ring-primary resize-none h-[100px] transition">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-end mt-2">
                            <x-primary-button class="w-[150px] h-[36px] mt-4">
                                Simpan
                            </x-primary-button>
                        </div>
                </form>
            </div>
        </div>

        <!-- Konten Halaman  -->
        <div class="flex gap-2">
            <!-- sisi kiri -->
            <div class="flex flex-col items-center w-1/3">
                <div class="bg-[#D0E4F5] w-60 h-60 flex items-center justify-center rounded">
                    <img src="img/playlist.png" alt="playlist" class="w-20 h-20" />
                </div>
                <h2 class="font-roboto text-[24px] font-semibold text-neu900 mt-4 text-center">
                    @if (!empty($criteria))
                        Berdasarkan preferensi Anda
                        <div class="mt-2 text-lg font-normal">
                            <p>Mood: {{ ucfirst($criteria['mood'] ?? 'Not specified') }}</p>
                            <p>Favorite Artists: {{ implode(', ', $criteria['favorite_artists'] ?? ['None']) }}</p>
                            <p>Favorite Genres: {{ implode(', ', $criteria['favorite_genres'] ?? ['None']) }}</p>
                        </div>
                    @endif
                </h2>
            </div>

            <!-- sisi kanan -->
            <div class="flex-1">
                <div class="flex items-center px-20 py-4">
                    <div class="flex-1 font-inter text-[14px] font-medium text-neu900">Judul</div>
                    <div class="flex-[0.2] text-center font-inter text-[14px] font-medium text-neu900">Duration</div>
                    <div class="flex-[0.5] text-center font-inter text-[14px] font-medium text-neu900">Mood</div>
                </div>

                @forelse ($recommended_songs as $song)
                    <div class="flex items-center bg-[#F1F8FC] rounded-md px-4 py-1 mb-3">
                        <div class="flex items-center justify-center w-6 h-6 mr-3 rounded-md text-primary">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex items-center flex-1 min-w-0 ml-3">
                            <div class="w-1/4 min-w-0 mr-6">
                                <p class="font-inter text-[16px] font-semibold text-neu900 truncate">
                                    {{ $song['song_name'] ?? 'Unknown Song' }}</p>
                                <p class="font-inter text-[16px] font-medium text-neu900 truncate">
                                    {{ $song['artist_id'] ?? 'Unknown Artist' }}</p>
                            </div>

                            <div class="flex items-center gap-1 bg-[#F1F8FC] rounded-md px-4 py-3 max-w-[600px] w-full">
                                <!-- Audio Player -->
                                <audio id="audio-{{ $song['id'] }}" src="{{ $song['file_url'] }}"></audio>

                                <!-- Play/Pause Button -->
                                <button onclick="togglePlay('{{ $song['id'] }}')"
                                    class="relative flex items-center justify-center w-8 h-8 text-white rounded-full playPauseBtn bg-primary">
                                    <svg id="play-icon-{{ $song['id'] }}" class="absolute inset-0 w-4 h-4 m-auto"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                    <svg id="pause-icon-{{ $song['id'] }}"
                                        class="absolute inset-0 hidden w-4 h-4 m-auto" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                                    </svg>
                                </button>

                                <!-- Current Time -->
                                <span id="current-time-{{ $song['id'] }}"
                                    class="text-sm text-gray-600 min-w-[42px] text-center">0:00</span>

                                <!-- Progress Bar -->
                                <input type="range" id="progress-{{ $song['id'] }}" value="0"
                                    class="flex-1 h-1 max-w-[350px] bg-gray-300 rounded-lg appearance-none cursor-pointer">

                                <!-- Duration -->
                                <span id="duration-{{ $song['id'] }}"
                                    class="text-sm text-gray-600 min-w-[42px] text-center">0:00</span>
                            </div>

                            <div class="flex items-center max-w-[150px] w-full">
                                <p class="font-inter text-[14px] font-medium text-[#3E4451] truncate pl-6">
                                    {{ ucfirst($song['mood'] ?? 'Unknown') }}</p>
                            </div>
                            <div class="flex items-center gap-2 ml-auto">
                                <!-- Tombol Add / Open Modal -->
                                <button @click="
                                if ($store.modalStore.playlists.length === 0) {
                                    $store.modalStore.openCreateModal = true;
                                } else {
                                    $store.modalStore.open = true;
                                }"
                                    class="w-4 h-4 text-[#adb5af] hover:text-primary" title="Tambah ke playlist">
                                    <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>

                                <button @click="liked = !liked" :class="liked ? 'text-[#f83b3e]' : 'text-[#adb5af]'"
                                    class="w-5 h-5 hover:text-[#f83b3e]" title="Favorite">
                                    <svg :fill="liked ? '#f83b3e' : 'none'" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                @empty
                    <div class="py-10 text-center">
                        <p class="text-lg text-gray-500">No recommendations found. Try adjusting your preferences.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/wavesurfer.js"></script>
    <script>
        // Fungsi untuk toggle play/pause
        function togglePlay(songId) {
            const audio = document.getElementById(`audio-${songId}`);
            const playIcon = document.getElementById(`play-icon-${songId}`);
            const pauseIcon = document.getElementById(`pause-icon-${songId}`);

            if (audio.paused) {
                audio.play();
                playIcon.classList.add('hidden');
                pauseIcon.classList.remove('hidden');
            } else {
                audio.pause();
                playIcon.classList.remove('hidden');
                pauseIcon.classList.add('hidden');
            }
        }

        // Update progress bar dan waktu
        document.querySelectorAll('audio').forEach(audio => {
            const songId = audio.id.split('-')[1];
            const progress = document.getElementById(`progress-${songId}`);
            const currentTime = document.getElementById(`current-time-${songId}`);
            const duration = document.getElementById(`duration-${songId}`);

            // Update duration ketika metadata loaded
            audio.addEventListener('loadedmetadata', () => {
                duration.textContent = formatTime(audio.duration);
            });

            // Update progress bar dan current time
            audio.addEventListener('timeupdate', () => {
                progress.value = (audio.currentTime / audio.duration) * 100;
                currentTime.textContent = formatTime(audio.currentTime);
            });

            // Seek functionality
            progress.addEventListener('input', () => {
                const seekTime = (progress.value / 100) * audio.duration;
                audio.currentTime = seekTime;
            });
        });

        // Format waktu (detik ke menit:detik)
        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
        }
    </script>

    <script>
        // document.addEventListener("DOMContentLoaded", () => {
        //     const wavesurfer = WaveSurfer.create({
        //         container: '#wave', // container utama waveform
        //         waveColor: '#e5f1fa',
        //         progressColor: '#7b9cd9',
        //         height: 24
        //     });

        //     wavesurfer.load("/audio/komang.mp3");

        //     const playButtons = document.querySelectorAll(".playPauseBtn");

        //     // Ambil semua ikon play/pause dari kedua tombol
        //     const playIcons = document.querySelectorAll(".playPauseBtn .play-icon");
        //     const pauseIcons = document.querySelectorAll(".playPauseBtn .pause-icon");

        //     const currentTimeEl = document.querySelector("#current");
        //     const durationEl = document.querySelector("#duration");

        //     // Tambahkan event listener ke semua tombol
        //     playButtons.forEach(button => {
        //         button.addEventListener("click", () => {
        //             wavesurfer.playPause();
        //         });
        //     });

        //     wavesurfer.on("ready", () => {
        //         durationEl.textContent = formatTime(wavesurfer.getDuration());
        //     });

        //     wavesurfer.on("audioprocess", () => {
        //         currentTimeEl.textContent = formatTime(wavesurfer.getCurrentTime());
        //     });

        //     wavesurfer.on("play", () => {
        //         playIcons.forEach(icon => icon.classList.add("hidden"));
        //         pauseIcons.forEach(icon => icon.classList.remove("hidden"));
        //     });

        //     wavesurfer.on("pause", () => {
        //         playIcons.forEach(icon => icon.classList.remove("hidden"));
        //         pauseIcons.forEach(icon => icon.classList.add("hidden"));
        //     });

        //     wavesurfer.on("finish", () => {
        //         playIcons.forEach(icon => icon.classList.remove("hidden"));
        //         pauseIcons.forEach(icon => icon.classList.add("hidden"));
        //         currentTimeEl.textContent = "0:00";
        //     });

        //     function formatTime(seconds) {
        //         const minutes = Math.floor(seconds / 60);
        //         const secs = Math.floor(seconds % 60).toString().padStart(2, '0');
        //         return `${minutes}:${secs}`;
        //     }
        // });
        document.addEventListener('alpine:init', () => {
            Alpine.store('modalStore', {
                open: false,
                openCreateModal: false,
                searchQuery: '',
                playlists: [],
                selectedPlaylistId: null, // Simpan ID saja untuk lebih sederhana
                currentSong: null,

                // Inisialisasi
                init() {
                    this.fetchPlaylists();
                },

                // Fetch playlists dari API
                async fetchPlaylists() {
                    try {
                        const response = await fetch('/playlists');
                        if (response.ok) {
                            this.playlists = await response.json();
                        } else {
                            console.error('Failed to fetch playlists');
                            this.playlists = [];
                        }
                    } catch (error) {
                        console.error('Error fetching playlists:', error);
                        this.playlists = [];
                    }
                },

                // Filter playlists berdasarkan pencarian
                get filteredPlaylists() {
                    if (!this.playlists) return [];
                    return this.playlists.filter(playlist =>
                        playlist.name.toLowerCase().includes(this.searchQuery.toLowerCase())
                    );
                },

                // Pilih playlist
                selectPlaylist(playlistId) {
                    this.selectedPlaylistId = playlistId;
                },

                // Cek apakah playlist terpilih
                isSelected(playlistId) {
                    return this.selectedPlaylistId === playlistId;
                },

                // Simpan seleksi ke API
                async saveSelection() {
                    // Validasi
                    if (!this.selectedPlaylistId || !this.currentSong?.id) {
                        console.error('Validation failed:', {
                            selectedPlaylistId: this.selectedPlaylistId,
                            currentSong: this.currentSong
                        });
                        alert('Silakan pilih playlist dan pastikan lagu terpilih');
                        return;
                    }

                    try {
                        const response = await fetch(`/playlists/${this.selectedPlaylistId}/add-song`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                song_id: this.currentSong.id
                            })
                        });

                        const data = await response.json();

                        if (data.success) {
                            alert('Lagu berhasil ditambahkan ke playlist!');
                            this.resetModal();
                        } else {
                            alert(data.message || 'Gagal menambahkan lagu ke playlist');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menambahkan lagu ke playlist');
                    }
                },

                // Buka modal dengan lagu yang dipilih
                openModal(song) {
                    if (!song?.id) {
                        console.error('Invalid song data:', song);
                        return;
                    }

                    this.currentSong = song;

                    if (this.playlists.length === 0) {
                        this.openCreateModal = true;
                    } else {
                        this.open = true;
                    }
                },

                // Reset state modal
                resetModal() {
                    this.open = false;
                    this.selectedPlaylistId = null;
                    this.searchQuery = '';
                }
            });
        });
    </script>
</x-app-layout>
