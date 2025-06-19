<x-app-layout>
    <style>
        body {
            background-color: #F9FAFB;
        }
    </style>

    <div class="w-full max-w-7xl px-6 mx-auto" x-data="{ openMood: true, mood: '', loading: false, result: null, liked: false }">
        <div class="w-full max-w-7xl px-6 mx-auto" x-data="{
            openMood: true,
            mood: '',
            loading: false,
            result: null,
            liked: false,
            open: false,
            openModal: false,
            selected: [],
            playlists: ['Calm', 'Focus']
        }">

            <!-- Modal Mood -->
            <div x-show="openMood" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
                <div
                    class="bg-[#f1f8fc] border-2 border-primary p-10 rounded-md shadow-lg w-full max-w-xl text-center relative">
                    <button @click="openMood = false"
                        class="absolute top-2 right-3 text-neu900 hover:text-neu900 text-xl bg-gray-200 rounded-full w-6 h-6 flex items-center justify-center hover:bg-gray-300">
                        &times;
                    </button>
                    <h2 class="font-inter text-[24px] font-semibold text-neu900">
                        Bagaimana perasaanmu hari ini?
                    </h2>
                    <p class="font-inter text-[18px] text-gray-400 mb-4">
                        Beri tahu kami mood kamu, dan kami akan memutar musik yang cocok!
                    </p>
                    <div class="flex justify-between px-6 text-center mt-8">
                        <div>
                            <button @click="fetchMood('sedih')" title="Sedih">
                                <img src="img/sedih.png" alt="Sedih" class="w-20 h-20 mx-auto" />
                            </button>
                            <p>Sedih</p>
                        </div>
                        <div>
                            <button @click="fetchMood('tenang')" title="Tenang">
                                <img src="img/tenang.png" alt="Tenang" class="w-20 h-20 mx-auto" />
                            </button>
                            <p>Tenang</p>
                        </div>
                        <div>
                            <button @click="fetchMood('senang')" title="Senang">
                                <img src="img/senang.png" alt="Senang" class="w-20 h-20 mx-auto" />
                            </button>
                            <p>Senang</p>
                        </div>
                        <div>
                            <button @click="fetchMood('semangat')" title="Semangat">
                                <img src="img/energik.png" alt="Energik" class="w-20 h-20 mx-auto" />
                            </button>
                            <p>Energik</p>
                        </div>
                    </div>
                    <template x-if="loading">
                        <p class="mt-4 text-primary text-sm">Mengambil lagu berdasarkan mood...</p>
                    </template>
                </div>
            </div>

            <!-- Modal playlist tersimpan -->
            <div x-show="$store.modalStore.open"
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
            <div x-show="$store.modalStore.openCreateModal"
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


        <!-- Playlist -->
        <section class="mt-6">
            <h1 class="font-roboto text-3xl font-semibold text-primary mb-4">Rekomendasi Playlist</h1>
            <div class="flex gap-4 overflow-x-auto pb-2">
                <div
                    class="min-w-[180px] bg-[#D0E4F5] rounded-md overflow-hidden shadow-sm hover:shadow-md transition duration-200">
                    <div class="h-40 bg-blue-200 flex items-center justify-center">
                        <img src="img/playlist.png" alt="playlist" class="w-20 h-20" />
                    </div>
                    <div class="p-3 bg-[#F1F8FC]">
                        <p class="font-inter text-[16px] font-medium text-[#181B19]">Stecu Stecu</p>
                        <p class="font-inter text-[14px] font-normal text-[#6e7971]">Faris Adam</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Artis Viral -->
        <section class="mt-10">
            <h1 class="font-roboto text-3xl font-semibold text-primary mb-4">Artis Viral</h1>
            <div class="flex space-x-6 overflow-x-auto scrollbar-hide pb-2 items-center">
                <div class="flex-shrink-0 flex flex-col items-center w-28">
                    <img src="img/hero.png" alt="artist"
                        class="w-28 h-28 rounded-full object-cover border-2 border-transparent hover:border-primary hover:shadow-lg transition duration-200" />
                    <p
                        class="mt-2 font-inter text-[16px] font-medium text-[#181B19] text-center w-28 break-words leading-tight line-clamp-2">
                        Stecu</p>
                </div>
            </div>
        </section>

        <!-- Audio Player -->
        <section class="mt-10">
            <div class="flex items-center px-20 py-2 text-sm font-semibold text-gray-700">
                <div class="flex-1 font-inter text-[14px] font-medium text-neu900">Judul</div>
                <div class="flex-[0.1] text-center font-inter text-[14px] font-medium text-neu900">Duration</div>
                <div class="flex-[0.5] text-center">
                    <select
                        class="text-sm font-inter font-medium text-neu900 bg-transparent border-none focus:outline-none focus:ring-0 focus:border-none appearance-none">
                        <option value="" disabled selected>Mood</option>
                        <option value="semangat">Semangat</option>
                        <option value="sedih">Sedih</option>
                        <option value="tenang">Tenang</option>
                        <option value="bingung">Bingung</option>
                    </select>
                </div>

            </div>

            <div class="flex items-center bg-[#F1F8FC] rounded-md px-4 py-1 mb-3">
                <img class="w-12 h-12 rounded-md object-cover" src="img/hero.png" alt="Foto lagu" />
                <div class="ml-3 flex-1 min-w-0 flex items-center">
                    <div class="min-w-0 max-w-[180px] mr-20">
                        <p class="font-inter text-[16px] font-semibold text-neu900 truncate">Komang</p>
                        <p class="font-inter text-[16px] font-medium text-neu900 truncate">Raim Laode</p>
                    </div>

                    <div class="flex items-center gap-1 bg-[#F1F8FC] rounded-md px-4 py-3 max-w-[600px] w-full">
                        <!-- Tombol Play/Pause -->
                        <div class="flex items-center gap-2">
                            <button id="playPause"
                                class="relative w-8 h-8 bg-primary rounded-full text-white flex items-center justify-center">
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
        </section>
    </div>

    <script src="https://unpkg.com/wavesurfer.js"></script>
    <script>
        function fetchMood(mood) {
            const root = document.querySelector('[x-data]');
            const alpine = Alpine.$data(root);
            alpine.loading = true;
            alpine.result = null;

            fetch(`/lagu-mood?mood=${mood}`)
                .then(res => res.json())
                .then(data => {
                    alpine.result = Array.isArray(data.message) ? data.message : (data.message ||
                        'Tidak ada lagu ditemukan.');
                    alpine.open = false;
                })
                .catch(() => {
                    alpine.result = 'Terjadi kesalahan saat mengambil data.';
                    alpine.open = false;
                })
                .finally(() => {
                    alpine.loading = false;
                });
        }
        window.fetchMood = fetchMood;

        document.addEventListener("DOMContentLoaded", () => {
            const wavesurfer = WaveSurfer.create({
                container: '#wave',
                waveColor: '#e5f1fa',
                progressColor: '#7b9cd9',
                height: 24
            });

            wavesurfer.load("/audio/komang.mp3");

            const playButton = document.querySelector("#playPause");
            const playIcon = playButton.querySelector(".play-icon");
            const pauseIcon = playButton.querySelector(".pause-icon");
            const currentTimeEl = document.querySelector("#current");
            const durationEl = document.querySelector("#duration");

            pauseIcon.classList.add("hidden");

            playButton.addEventListener("click", () => {
                wavesurfer.playPause();
            });

            wavesurfer.on("ready", () => {
                durationEl.textContent = formatTime(wavesurfer.getDuration());
            });

            wavesurfer.on("audioprocess", () => {
                currentTimeEl.textContent = formatTime(wavesurfer.getCurrentTime());
            });

            wavesurfer.on("play", () => {
                playIcon.classList.add("hidden");
                pauseIcon.classList.remove("hidden");
            });

            wavesurfer.on("pause", () => {
                playIcon.classList.remove("hidden");
                pauseIcon.classList.add("hidden");
            });

            wavesurfer.on("finish", () => {
                playIcon.classList.remove("hidden");
                pauseIcon.classList.add("hidden");
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
                playlists: [], // data playlist
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
