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

                    <!-- Playlist Item -->
                    <template x-for="playlist in $store.modalStore.filteredPlaylists" :key="playlist">
                        <div @click="$store.modalStore.toggleSelected(playlist)"
                            class="flex items-center justify-between p-2 rounded hover:bg-[#f1f8fc] cursor-pointer transition"
                            :class="{ 'bg-[#e1f0ff]': $store.modalStore.selected.includes(playlist) }">
                            <div class="flex items-center gap-3">
                                <div class="bg-[#D0E4F5] w-10 h-10 rounded flex items-center justify-center">
                                    <img src="img/playlist.png" alt="playlist" class="w-[20px] h-[20px]" />
                                </div>
                                <div>
                                    <p class="text-[14px] font-medium text-neu900" x-text="playlist"></p>
                                    <p class="text-[12px] font-medium text-[#ADB5AF]">5 lagu</p>
                                </div>
                            </div>
                            <div class="w-5 h-5 rounded-xl border-2 border-[#516ab1] flex items-center justify-center">
                                <div class="w-2 h-2 rounded bg-primary"
                                    x-show="$store.modalStore.selected.includes(playlist)"></div>
                            </div>
                        </div>
                    </template>

                    <div class="flex justify-between mt-4">
                        <x-secondary-button @click="$store.modalStore.open = false" class="w-[150px] h-[36px]">
                            Kembali
                        </x-secondary-button>
                        <x-primary-button @click="$store.modalStore.saveSelection" class="w-[150px] h-[36px]">
                            Simpan
                        </x-primary-button>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Playlist -->
            <div x-cloak x-show="$store.modalStore.openCreateModal"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div
                    class="bg-[#f1f8fc] border-2 border-primary rounded-md shadow-lg p-10 relative w-[600px] h-[320px]">
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
                            <input type="text" placeholder="Nama playlist"
                                class="p-2 rounded bg-[#EBEDEC] placeholder:text-[#ADB5AF] text-sm focus:outline-none focus:ring-2 focus:ring-primary transition" />
                            <textarea placeholder="Tambahkan deskripsi (opsional)"
                                class="p-2 rounded bg-[#EBEDEC] placeholder:text-[#ADB5AF] text-sm focus:outline-none focus:ring-2 focus:ring-primary resize-none h-[100px] transition"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end mt-2">
                        <x-primary-button class="w-[150px] h-[36px] mt-4">
                            Simpan
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten Halaman  -->
        <div class="flex gap-2">
            <!-- sisi kiri -->
            <div class="flex flex-col items-center w-1/3">
                <div class="relative flex items-center justify-center bg-gray-200 rounded-lg shadow-md w-60 h-60">
                    {{-- Gambar Artis --}}
                    <img src="{{ $artist['image_url'] ?? 'https://placehold.co/240x240/D0E4F5/181B19?text=Artis' }}"
                        alt="{{ $artist['name'] }}" class="object-cover w-full h-full rounded-lg"
                        onerror="this.onerror=null;this.src='https://placehold.co/240x240/D0E4F5/181B19?text=Gagal+Muat';" />
                    {{-- Tombol Like --}}
                    {{-- <button @click="liked = !liked" :class="liked ? 'text-[#f83b3e]' : 'text-white'"
                        class="absolute bottom-3 right-3 w-8 h-8 hover:text-[#f83b3e] transition-colors"
                        title="Favorite">
                        <svg fill="currentColor" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button> --}}
                    <button @click="toggleFavorite" :class="isFavorite ? 'text-[#f83b3e]' : 'text-white'"
                        class="absolute bottom-3 right-3 w-8 h-8 hover:text-[#f83b3e] transition-colors"
                        title="Favorite" x-data="{
                            isFavorite: {{ collect($favoriteArtists)->contains('id', $artistId) ? 'true' : 'false' }},
                            artistId: '{{ $artistId }}',
                            toggleFavorite() {
                                fetch(`/artists/${this.artistId}/toggle-favorite`, {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({})
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            this.isFavorite = data.is_favorite;
                                            // Optional: Show notification
                                            alert(data.message);
                                        } else {
                                            console.error('Error:', data.error);
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    });
                            }
                        }">
                        <svg fill="currentColor" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>
                </div>
                <h2 class="font-roboto text-[24px] font-semibold text-neu900">{{ $artist['name'] }}</h2>
                <p class="mt-2 text-sm font-medium font-inter text-primary">
                    {{ count($artist['songs']) }} lagu
                </p>
                <button
                    class="relative flex items-center justify-center w-16 h-16 mt-4 text-white rounded-full playPauseBtn bg-primary">
                    <!-- Ikon Play -->
                    <svg class="absolute inset-0 w-8 h-8 m-auto play-icon" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z" />
                    </svg>
                    <!-- Ikon Pause -->
                    <svg class="absolute inset-0 hidden w-20 h-20 m-auto pause-icon" fill="currentColor"
                        viewBox="0 0 33 24">
                        <path d="M10 9h2v6h-2zM14 9h2v6h-2z" />
                    </svg>
                </button>
            </div>

            <!-- sisi kanan -->
            {{-- <div class="flex-1">
                <div class="flex items-center px-20 py-4">
                    <div class="flex-1 font-inter text-[14px] font-medium text-neu900">Judul</div>
                    <div class="flex-[0.2] text-center font-inter text-[14px] font-medium text-neu900">Duration</div>
                    <div class="flex-[0.5] text-center font-inter text-[14px] font-medium text-neu900">Mood</div>
                </div>


                <div class="flex items-center bg-[#F1F8FC] rounded-md px-4 py-1 mb-3">
                    <img class="object-cover w-12 h-12 rounded-md" src="img/hero.png" alt="Foto lagu" />
                    <div class="flex items-center flex-1 min-w-0 ml-3">
                        <div class="w-1/4 min-w-0 mr-6">
                            <p class="font-inter text-[16px] font-semibold text-neu900 truncate">Komang</p>
                            <p class="font-inter text-[16px] font-medium text-neu900 truncate">Raim Laode</p>
                        </div>

                        <div class="flex items-center gap-1 bg-[#F1F8FC] rounded-md px-4 py-3 max-w-[600px] w-full">
                            <!-- Tombol Play/Pause -->
                            <div class="flex items-center gap-2">
                                <button
                                    class="relative flex items-center justify-center w-8 h-8 text-white rounded-full playPauseBtn bg-primary">
                                    <!-- Ikon Play -->
                                    <svg class="absolute inset-0 w-4 h-4 m-auto play-icon" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                    <!-- Ikon Pause -->
                                    <svg class="absolute inset-0 hidden w-10 h-10 m-auto pause-icon" fill="currentColor"
                                        viewBox="0 0 32 24">
                                        <path d="M10 9h2v6h-2zM14 9h2v6h-2z" />
                                    </svg>
                                </button>
                                <span id="current" class="text-sm text-gray-600 min-w-[42px] text-center">0:00</span>
                            </div>

                            <!-- Visualisasi -->
                            <div id="wave" class="flex-1 h-[24px] max-w-[350px] overflow-hidden rounded"></div>

                            <!-- Durasi -->
                            <span id="duration" class="text-sm text-gray-600 min-w-[42px] text-center">0:00</span>
                        </div>

                        <div class="flex items-center max-w-[150px] w-full">
                            <p class="font-inter text-[14px] font-medium text-[#3E4451] truncate">Bersemangat, Sedih,
                                Senang
                            </p>
                        </div>
                        <div class="flex items-center gap-2 ml-auto">
                            <!-- Tombol Add / Open Modal -->
                            <button @click="
                                if ($store.modalStore.playlists.length === 0) {
                                    $store.modalStore.openCreateModal = true;
                                } else {$store.modalStore.open = true;}"
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
            </div> --}}
            <div class="flex-1">
                <div class="flex items-center px-20 py-4">
                    <div class="flex-1 font-inter text-[14px] font-medium text-neu900">Judul</div>
                    <div class="flex-[0.2] text-center font-inter text-[14px] font-medium text-neu900">Duration</div>
                    <div class="flex-[0.5] text-center font-inter text-[14px] font-medium text-neu900">Mood</div>
                </div>

                @if (empty($artist['songs']))
                <div class="py-8 text-center font-inter text-neu900">Tidak ada data lagu</div>
                @else
                @foreach ($artist['songs'] as $song)
                <div class="flex items-center bg-[#F1F8FC] rounded-md px-4 py-1 mb-3">
                    <img class="object-cover w-12 h-12 rounded-md" src="{{ $artist['image_url'] }}" alt="Foto lagu" />
                    <div class="flex items-center flex-1 min-w-0 ml-3">
                        <div class="w-1/4 min-w-0 mr-6">
                            <p class="font-inter text-[16px] font-semibold text-neu900 truncate">
                                {{ $song['song_name'] }}</p>
                            <p class="font-inter text-[16px] font-medium text-neu900 truncate">
                                {{ $artist['name'] }}</p>
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
                                <svg id="pause-icon-{{ $song['id'] }}" class="absolute inset-0 hidden w-4 h-4 m-auto"
                                    fill="currentColor" viewBox="0 0 24 24">
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
                            <p class="font-inter text-[14px] font-medium text-[#3E4451] truncate">
                                {{ $song['mood'] }}</p>
                        </div>
                        <div class="flex items-center gap-2 ml-auto">
                            <!-- Tombol Add / Open Modal -->
                            <button @click="
                            if ($store.modalStore.playlists.length === 0) {
                                $store.modalStore.openCreateModal = true;
                            } else {$store.modalStore.open = true;}" class="w-4 h-4 text-[#adb5af] hover:text-primary"
                                title="Tambah ke playlist">
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
                @endforeach

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
                @endif
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/wavesurfer.js">
        // Optional: Global Wavesurfer configuration
        document.addEventListener('alpine:init', () => {
            Alpine.data('audioPlayer', () => ({
                // Configuration can be added here if needed
            }));
        });

        {{--  <script>
        document.addEventListener("DOMContentLoaded", () => {
            const wavesurfer = WaveSurfer.create({
                container: '#wave', // container utama waveform
                waveColor: '#e5f1fa',
                progressColor: '#7b9cd9',
                height: 24
            });

            wavesurfer.load("/audio/komang.mp3");

            const playButtons = document.querySelectorAll(".playPauseBtn");

            // Ambil semua ikon play/pause dari kedua tombol
            const playIcons = document.querySelectorAll(".playPauseBtn .play-icon");
            const pauseIcons = document.querySelectorAll(".playPauseBtn .pause-icon");

            const currentTimeEl = document.querySelector("#current");
            const durationEl = document.querySelector("#duration");

            // Tambahkan event listener ke semua tombol
            playButtons.forEach(button => {
                button.addEventListener("click", () => {
                    wavesurfer.playPause();
                });
            });

            wavesurfer.on("ready", () => {
                durationEl.textContent = formatTime(wavesurfer.getDuration());
            });

            wavesurfer.on("audioprocess", () => {
                currentTimeEl.textContent = formatTime(wavesurfer.getCurrentTime());
            });

            wavesurfer.on("play", () => {
                playIcons.forEach(icon => icon.classList.add("hidden"));
                pauseIcons.forEach(icon => icon.classList.remove("hidden"));
            });

            wavesurfer.on("pause", () => {
                playIcons.forEach(icon => icon.classList.remove("hidden"));
                pauseIcons.forEach(icon => icon.classList.add("hidden"));
            });

            wavesurfer.on("finish", () => {
                playIcons.forEach(icon => icon.classList.remove("hidden"));
                pauseIcons.forEach(icon => icon.classList.add("hidden"));
                currentTimeEl.textContent = "0:00";
            });

            function formatTime(seconds) {
                const minutes = Math.floor(seconds / 60);
                const secs = Math.floor(seconds % 60).toString().padStart(2, '0');
                return `${minutes}:${secs}`;
            }
        });  --}}
        document.addEventListener('alpine:init', () => {
            Alpine.store('modalStore', {
                open: false,
                openCreateModal: false,
                searchQuery: '',
                playlists: ['Calm', 'Focus'], // data playlist
                selected: [],
                toggleSelected(playlist) {
                    if (this.selected.includes(playlist)) {
                        this.selected = this.selected.filter(i => i !== playlist);
                    } else {
                        this.selected.push(playlist);
                    }
                },
                saveSelection() {
                    console.log('Selected playlists:', this.selected);
                    this.open = false;
                },
                get filteredPlaylists() {
                    return this.playlists.filter(p =>
                        p.toLowerCase().includes(this.searchQuery.toLowerCase())
                    );
                },
                //Fungsi cek playlist kosong
                isPlaylistEmpty() {
                    return this.playlists.length === 0;
                }
            });
        });
    </script>

</x-app-layout>
