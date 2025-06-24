<x-app-layout>
    {{-- Background --}}
    <style>
        body {
            background-color: #F9FAFB;
        }
    </style>

    {{-- Kontainer utama --}}
    <div class="w-full max-w-7xl px-6 mx-auto" x-data="{
        result: null,
        liked: false,
        open: false,
        openModal: false,
        selected: [],
        playlists: ['Calm', 'Focus']}">
        <div class="w-full max-w-7xl px-6 mx-auto">

            <!-- Modal playlist tersimpan -->
            <div x-cloak x-show="$store.modalStore.open"
                class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="bg-[#f1f8fc] border-2 border-primary rounded-lg p-10 w-[400px]">
                    <div class="flex items-center mb-6">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
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
                                <div class="w-2 h-2 bg-primary rounded"
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
                        class="absolute top-2 right-3 text-neu900 hover:text-neu900 text-xl bg-gray-200 rounded-full w-6 h-6 flex items-center justify-center hover:bg-gray-300">
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
                <div class="bg-[#D0E4F5] w-60 h-60 flex items-center justify-center rounded">
                    <img src="img/playlist.png" alt="playlist" class="w-20 h-20" />
                </div>
                <h2 class="font-roboto text-[24px] font-semibold text-neu900">Nama Playlist</h2>
                <p class="font-inter text-[16px] font-medium text-[#adb5af] mb-8">Deskripsi Playlist</p>
                <p class="font-inter text-[14px] font-medium text-primary">10 lagu | 35 Menit</p>
                <button
                    class="mt-4 playPauseBtn relative w-16 h-16 bg-primary rounded-full text-white flex items-center justify-center">
                    <!-- Ikon Play -->
                    <svg class="play-icon absolute inset-0 m-auto w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z" />
                    </svg>
                    <!-- Ikon Pause -->
                    <svg class="pause-icon absolute inset-0 m-auto w-20 h-20 hidden" fill="currentColor"
                        viewBox="0 0 33 24">
                        <path d="M10 9h2v6h-2zM14 9h2v6h-2z" />
                    </svg>
                </button>
            </div>

            <!-- sisi kanan -->
            <div class="flex-1">
                <div class="flex items-center px-20 py-4">
                    <div class="flex-1 font-inter text-[14px] font-medium text-neu900">Judul</div>
                    <div class="flex-[0.2] text-center font-inter text-[14px] font-medium text-neu900">Duration</div>
                    <div class="flex-[0.5] text-center font-inter text-[14px] font-medium text-neu900">Mood</div>
                </div>


                <div class="flex items-center bg-[#F1F8FC] rounded-md px-4 py-1 mb-3">
                    <img class="w-12 h-12 rounded-md object-cover" src="img/hero.png" alt="Foto lagu" />
                    <div class="ml-3 flex-1 min-w-0 flex items-center">
                        <div class="min-w-0 w-1/4 mr-6">
                            <p class="font-inter text-[16px] font-semibold text-neu900 truncate">Komang</p>
                            <p class="font-inter text-[16px] font-medium text-neu900 truncate">Raim Laode</p>
                        </div>

                        <div class="flex items-center gap-1 bg-[#F1F8FC] rounded-md px-4 py-3 max-w-[600px] w-full">
                            <!-- Tombol Play/Pause -->
                            <div class="flex items-center gap-2">
                                <button
                                    class="playPauseBtn relative w-8 h-8 bg-primary rounded-full text-white flex items-center justify-center">
                                    <!-- Ikon Play -->
                                    <svg class="play-icon absolute inset-0 m-auto w-4 h-4" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z" />
                                    </svg>
                                    <!-- Ikon Pause -->
                                    <svg class="pause-icon absolute inset-0 m-auto w-10 h-10 hidden" fill="currentColor"
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
                            <button
                                @click="
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
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/wavesurfer.js"></script>
    <script>
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
        });
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
