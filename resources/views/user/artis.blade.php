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

            <!-- Modal Mood -->
            <div x-data="{
                {{--  openMood: true,
                loading: false,
                result: null,  --}}
                openMood: false,
                    loading: false,
                    result: null,
                    checkMoodInterval() {
                        const lastShown = localStorage.getItem('moodLastShown');
                        const now = new Date().getTime();

                        if (!lastShown || now - lastShown > 3 * 60 * 60 * 1000) {
                            this.openMood = true;
                            localStorage.setItem('moodLastShown', now);
                        }
                    },
                    moodMap: {
                        'senang': 'happy',
                        'tenang': 'relax',
                        'sedih': 'sad',
                        'marah': 'tense'
                    },
                    async fetchMood(mood) {
                        this.loading = true;
                        const apiMood = this.moodMap[mood] || 'happy';

                        try {
                            const response = await fetch('/save-mood', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ mood: apiMood })
                            });

                            const data = await response.json();

                            if (data.success) {
                                console.log('Berhasil menyimpan mood:', {
                                    mood: mood,
                                    apiMood: apiMood,
                                    response: data.message,
                                    timestamp: new Date().toISOString()
                                });
                                this.result = mood;
                                this.openMood = false;
                                // Anda bisa tambahkan logika lain setelah berhasil menyimpan mood
                            } else {
                                alert('Gagal menyimpan mood: ' + data.message);
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat menyimpan mood');
                        } finally {
                            this.loading = false;
                        }
                    }

            }" x-init="checkMoodInterval()" x-cloak x-show="openMood"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div
                    class="bg-[#f1f8fc] border-2 border-primary p-10 rounded-md shadow-lg w-full max-w-xl text-center relative">
                    <button @click="openMood = false"
                        class="absolute flex items-center justify-center w-6 h-6 text-xl bg-gray-200 rounded-full top-2 right-3 text-neu900 hover:text-neu900 hover:bg-gray-300">
                        &times;
                    </button>
                    <h2 class="font-inter text-[24px] font-semibold text-neu900">
                        Bagaimana perasaanmu hari ini?
                    </h2>
                    <p class="font-inter text-[18px] text-gray-400 mb-4">
                        Beri tahu kami mood kamu, dan kami akan memutar musik yang cocok!
                    </p>
                    <div class="flex justify-between px-6 mt-8 text-center">
                        <div>
                            <button @click="fetchMood('sedih')" title="Sedih">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="61" viewBox="0 0 60 61"
                                    fill="none">
                                    <mask id="mask0_923_1767" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="80" height="80">
                                        <rect y="0.5" width="60" height="60" fill="#D9D9D9" />
                                    </mask>
                                    <g mask="url(#mask0_923_1767)">
                                        <path
                                            d="M18.625 32L27.5625 25.5L18.625 19L16.375 22L21.1875 25.5L16.375 29L18.625 32ZM41.375 32L43.625 29L38.8125 25.5L43.625 22L41.375 19L32.4375 25.5L41.375 32ZM26.25 43.125L30 39.375L33.75 43.125L37.5 39.375L39.9375 41.8125L42.5625 39.1875L37.5 34.125L33.75 37.875L30 34.125L26.25 37.875L22.5 34.125L17.4375 39.1875L20.0625 41.8125L22.5 39.375L26.25 43.125ZM30 55.5C26.5417 55.5 23.2917 54.8438 20.25 53.5312C17.2083 52.2188 14.5625 50.4375 12.3125 48.1875C10.0625 45.9375 8.28125 43.2917 6.96875 40.25C5.65625 37.2083 5 33.9583 5 30.5C5 27.0417 5.65625 23.7917 6.96875 20.75C8.28125 17.7083 10.0625 15.0625 12.3125 12.8125C14.5625 10.5625 17.2083 8.78125 20.25 7.46875C23.2917 6.15625 26.5417 5.5 30 5.5C33.4583 5.5 36.7083 6.15625 39.75 7.46875C42.7917 8.78125 45.4375 10.5625 47.6875 12.8125C49.9375 15.0625 51.7188 17.7083 53.0312 20.75C54.3438 23.7917 55 27.0417 55 30.5C55 33.9583 54.3438 37.2083 53.0312 40.25C51.7188 43.2917 49.9375 45.9375 47.6875 48.1875C45.4375 50.4375 42.7917 52.2188 39.75 53.5312C36.7083 54.8438 33.4583 55.5 30 55.5ZM30 50.5C35.5833 50.5 40.3125 48.5625 44.1875 44.6875C48.0625 40.8125 50 36.0833 50 30.5C50 24.9167 48.0625 20.1875 44.1875 16.3125C40.3125 12.4375 35.5833 10.5 30 10.5C24.4167 10.5 19.6875 12.4375 15.8125 16.3125C11.9375 20.1875 10 24.9167 10 30.5C10 36.0833 11.9375 40.8125 15.8125 44.6875C19.6875 48.5625 24.4167 50.5 30 50.5Z"
                                            fill="#6E7971" />
                                    </g>
                                </svg>
                            </button>
                            <p>Sedih</p>
                        </div>
                        <div>
                            <button @click="fetchMood('tenang')" title="Tenang">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="61" viewBox="0 0 60 61"
                                    fill="none">
                                    <mask id="mask0_923_1770" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="60" height="61">
                                        <rect y="0.5" width="60" height="60" fill="#D9D9D9" />
                                    </mask>
                                    <g mask="url(#mask0_923_1770)">
                                        <path
                                            d="M21.25 30.5C23 30.5 24.4583 29.8646 25.625 28.5938C26.7917 27.3229 27.6042 25.8125 28.0625 24.0625L24.4375 23.1875C24.2292 24.1042 23.8646 24.9271 23.3438 25.6562C22.8229 26.3854 22.125 26.75 21.25 26.75C20.375 26.75 19.6771 26.3854 19.1562 25.6562C18.6354 24.9271 18.2708 24.1042 18.0625 23.1875L14.4375 24.0625C14.8958 25.8125 15.7083 27.3229 16.875 28.5938C18.0417 29.8646 19.5 30.5 21.25 30.5ZM30 44.25C31.625 44.25 33.1875 43.8854 34.6875 43.1562C36.1875 42.4271 37.5833 41.3333 38.875 39.875L36.125 37.375C35.2083 38.375 34.2292 39.1354 33.1875 39.6562C32.1458 40.1771 31.0833 40.4375 30 40.4375C28.9167 40.4375 27.8542 40.1771 26.8125 39.6562C25.7708 39.1354 24.7917 38.375 23.875 37.375L21.125 39.875C22.4583 41.3333 23.8646 42.4271 25.3438 43.1562C26.8229 43.8854 28.375 44.25 30 44.25ZM38.75 30.5C40.5 30.5 41.9583 29.8646 43.125 28.5938C44.2917 27.3229 45.1042 25.8125 45.5625 24.0625L41.9375 23.1875C41.7292 24.1042 41.3646 24.9271 40.8438 25.6562C40.3229 26.3854 39.625 26.75 38.75 26.75C37.875 26.75 37.1771 26.3854 36.6562 25.6562C36.1354 24.9271 35.7708 24.1042 35.5625 23.1875L31.9375 24.0625C32.3958 25.8125 33.2083 27.3229 34.375 28.5938C35.5417 29.8646 37 30.5 38.75 30.5ZM30 55.5C26.5417 55.5 23.2917 54.8438 20.25 53.5312C17.2083 52.2188 14.5625 50.4375 12.3125 48.1875C10.0625 45.9375 8.28125 43.2917 6.96875 40.25C5.65625 37.2083 5 33.9583 5 30.5C5 27.0417 5.65625 23.7917 6.96875 20.75C8.28125 17.7083 10.0625 15.0625 12.3125 12.8125C14.5625 10.5625 17.2083 8.78125 20.25 7.46875C23.2917 6.15625 26.5417 5.5 30 5.5C33.4583 5.5 36.7083 6.15625 39.75 7.46875C42.7917 8.78125 45.4375 10.5625 47.6875 12.8125C49.9375 15.0625 51.7188 17.7083 53.0312 20.75C54.3438 23.7917 55 27.0417 55 30.5C55 33.9583 54.3438 37.2083 53.0312 40.25C51.7188 43.2917 49.9375 45.9375 47.6875 48.1875C45.4375 50.4375 42.7917 52.2188 39.75 53.5312C36.7083 54.8438 33.4583 55.5 30 55.5ZM30 50.5C35.5833 50.5 40.3125 48.5625 44.1875 44.6875C48.0625 40.8125 50 36.0833 50 30.5C50 24.9167 48.0625 20.1875 44.1875 16.3125C40.3125 12.4375 35.5833 10.5 30 10.5C24.4167 10.5 19.6875 12.4375 15.8125 16.3125C11.9375 20.1875 10 24.9167 10 30.5C10 36.0833 11.9375 40.8125 15.8125 44.6875C19.6875 48.5625 24.4167 50.5 30 50.5Z"
                                            fill="#6E7971" />
                                    </g>
                                </svg>
                            </button>
                            <p>Tenang</p>
                        </div>
                        <div>
                            <button @click="fetchMood('senang')" title="Senang">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="61" viewBox="0 0 60 61"
                                    fill="none">
                                    <mask id="mask0_923_1773" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="60" height="61">
                                        <rect y="0.5" width="60" height="60" fill="#D9D9D9" />
                                    </mask>
                                    <g mask="url(#mask0_923_1773)">
                                        <path
                                            d="M38.75 28C39.7917 28 40.6771 27.6354 41.4062 26.9062C42.1354 26.1771 42.5 25.2917 42.5 24.25C42.5 23.2083 42.1354 22.3229 41.4062 21.5938C40.6771 20.8646 39.7917 20.5 38.75 20.5C37.7083 20.5 36.8229 20.8646 36.0938 21.5938C35.3646 22.3229 35 23.2083 35 24.25C35 25.2917 35.3646 26.1771 36.0938 26.9062C36.8229 27.6354 37.7083 28 38.75 28ZM21.25 28C22.2917 28 23.1771 27.6354 23.9062 26.9062C24.6354 26.1771 25 25.2917 25 24.25C25 23.2083 24.6354 22.3229 23.9062 21.5938C23.1771 20.8646 22.2917 20.5 21.25 20.5C20.2083 20.5 19.3229 20.8646 18.5938 21.5938C17.8646 22.3229 17.5 23.2083 17.5 24.25C17.5 25.2917 17.8646 26.1771 18.5938 26.9062C19.3229 27.6354 20.2083 28 21.25 28ZM30 44.25C32.8333 44.25 35.4063 43.4479 37.7188 41.8438C40.0312 40.2396 41.7083 38.125 42.75 35.5H38.625C37.7083 37.0417 36.4896 38.2604 34.9688 39.1562C33.4479 40.0521 31.7917 40.5 30 40.5C28.2083 40.5 26.5521 40.0521 25.0312 39.1562C23.5104 38.2604 22.2917 37.0417 21.375 35.5H17.25C18.2917 38.125 19.9688 40.2396 22.2812 41.8438C24.5938 43.4479 27.1667 44.25 30 44.25ZM30 55.5C26.5417 55.5 23.2917 54.8438 20.25 53.5312C17.2083 52.2188 14.5625 50.4375 12.3125 48.1875C10.0625 45.9375 8.28125 43.2917 6.96875 40.25C5.65625 37.2083 5 33.9583 5 30.5C5 27.0417 5.65625 23.7917 6.96875 20.75C8.28125 17.7083 10.0625 15.0625 12.3125 12.8125C14.5625 10.5625 17.2083 8.78125 20.25 7.46875C23.2917 6.15625 26.5417 5.5 30 5.5C33.4583 5.5 36.7083 6.15625 39.75 7.46875C42.7917 8.78125 45.4375 10.5625 47.6875 12.8125C49.9375 15.0625 51.7188 17.7083 53.0312 20.75C54.3438 23.7917 55 27.0417 55 30.5C55 33.9583 54.3438 37.2083 53.0312 40.25C51.7188 43.2917 49.9375 45.9375 47.6875 48.1875C45.4375 50.4375 42.7917 52.2188 39.75 53.5312C36.7083 54.8438 33.4583 55.5 30 55.5ZM30 50.5C35.5833 50.5 40.3125 48.5625 44.1875 44.6875C48.0625 40.8125 50 36.0833 50 30.5C50 24.9167 48.0625 20.1875 44.1875 16.3125C40.3125 12.4375 35.5833 10.5 30 10.5C24.4167 10.5 19.6875 12.4375 15.8125 16.3125C11.9375 20.1875 10 24.9167 10 30.5C10 36.0833 11.9375 40.8125 15.8125 44.6875C19.6875 48.5625 24.4167 50.5 30 50.5Z"
                                            fill="#6E7971" />
                                    </g>
                                </svg>
                            </button>
                            <p>Senang</p>
                        </div>
                        <div>
                            <button @click="fetchMood('marah')" title="Marah">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="61" viewBox="0 0 60 61"
                                    fill="none">
                                    <mask id="mask0_923_1776" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0"
                                        y="0" width="60" height="61">
                                        <rect y="0.5" width="60" height="60" fill="#D9D9D9" />
                                    </mask>
                                    <g mask="url(#mask0_923_1776)">
                                        <path
                                            d="M20 30.5V35.5C20 38.25 20.9792 40.6042 22.9375 42.5625C24.8958 44.5208 27.25 45.5 30 45.5C32.75 45.5 35.1042 44.5208 37.0625 42.5625C39.0208 40.6042 40 38.25 40 35.5V30.5H20ZM30 41.75C28.25 41.75 26.7708 41.1458 25.5625 39.9375C24.3542 38.7292 23.75 37.25 23.75 35.5V34.25H36.25V35.5C36.25 37.25 35.6458 38.7292 34.4375 39.9375C33.2292 41.1458 31.75 41.75 30 41.75ZM21.25 18C19.6667 18 18.2604 18.5729 17.0312 19.7188C15.8021 20.8646 14.9375 22.4375 14.4375 24.4375L18.0625 25.3125C18.3125 24.2292 18.7292 23.3646 19.3125 22.7188C19.8958 22.0729 20.5417 21.75 21.25 21.75C21.9583 21.75 22.6042 22.0729 23.1875 22.7188C23.7708 23.3646 24.1875 24.2292 24.4375 25.3125L28.0625 24.4375C27.5625 22.4375 26.6979 20.8646 25.4688 19.7188C24.2396 18.5729 22.8333 18 21.25 18ZM38.75 18C37.1667 18 35.7604 18.5729 34.5312 19.7188C33.3021 20.8646 32.4375 22.4375 31.9375 24.4375L35.5625 25.3125C35.8125 24.2292 36.2292 23.3646 36.8125 22.7188C37.3958 22.0729 38.0417 21.75 38.75 21.75C39.4583 21.75 40.1042 22.0729 40.6875 22.7188C41.2708 23.3646 41.6875 24.2292 41.9375 25.3125L45.5625 24.4375C45.0625 22.4375 44.1979 20.8646 42.9688 19.7188C41.7396 18.5729 40.3333 18 38.75 18ZM30 55.5C26.5417 55.5 23.2917 54.8438 20.25 53.5312C17.2083 52.2188 14.5625 50.4375 12.3125 48.1875C10.0625 45.9375 8.28125 43.2917 6.96875 40.25C5.65625 37.2083 5 33.9583 5 30.5C5 27.0417 5.65625 23.7917 6.96875 20.75C8.28125 17.7083 10.0625 15.0625 12.3125 12.8125C14.5625 10.5625 17.2083 8.78125 20.25 7.46875C23.2917 6.15625 26.5417 5.5 30 5.5C33.4583 5.5 36.7083 6.15625 39.75 7.46875C42.7917 8.78125 45.4375 10.5625 47.6875 12.8125C49.9375 15.0625 51.7188 17.7083 53.0312 20.75C54.3438 23.7917 55 27.0417 55 30.5C55 33.9583 54.3438 37.2083 53.0312 40.25C51.7188 43.2917 49.9375 45.9375 47.6875 48.1875C45.4375 50.4375 42.7917 52.2188 39.75 53.5312C36.7083 54.8438 33.4583 55.5 30 55.5ZM30 50.5C35.5833 50.5 40.3125 48.5625 44.1875 44.6875C48.0625 40.8125 50 36.0833 50 30.5C50 24.9167 48.0625 20.1875 44.1875 16.3125C40.3125 12.4375 35.5833 10.5 30 10.5C24.4167 10.5 19.6875 12.4375 15.8125 16.3125C11.9375 20.1875 10 24.9167 10 30.5C10 36.0833 11.9375 40.8125 15.8125 44.6875C19.6875 48.5625 24.4167 50.5 30 50.5Z"
                                            fill="#6E7971" />
                                    </g>
                                </svg>
                            </button>
                            <p>Marah</p>
                        </div>
                    </div>
                    <template x-if="loading">
                        <p class="mt-4 text-sm text-primary">Mengambil lagu berdasarkan mood...</p>
                    </template>
                </div>
            </div>

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
                                <input name="name" type="text" placeholder="Nama playlist" value="{{ old('name') }}"
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
                <button @click="toggleFavorite" :class="isFavorite ? 'text-[#f83b3e]' : 'text-white'"
                    class="absolute bottom-3 right-3 w-8 h-8 hover:text-[#f83b3e] transition-colors" title="Favorite"
                    x-data="{
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
            <p class="mt-1 text-sm font-medium font-inter text-primary">
                {{ count($artist['songs']) }} lagu
            </p>
        </div>

        <!-- sisi kanan -->
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
                        <p class="font-inter text-[14px] font-medium text-[#3E4451] truncate pl-4">
                            {{ $song['mood'] }}</p>
                    </div>
                    <div class="flex items-center gap-2 ml-auto">
                        <!-- Tombol Add / Open Modal -->
                        <button @click="$store.modalStore.openModal(@js($song))"
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

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('audioPlayer', () => ({
                // Configuration can be added here if needed
            }));
        });

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
