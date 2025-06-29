<!-- Sidebar -->
<div class="fixed top-16 inset-y-0 left-0 z-40 w-[240px] bg-[#7B9CD9] hidden lg:block shadow-[4px_0_8px_rgba(0,0,0,0.3)]"
    x-data>

    <!-- Toast Notification -->
    <div class="flex flex-col h-full p-4 pt-10 space-y-3 overflow-y-auto text-sm font-medium font-inter">
        <div x-cloak x-show="$store.modalStore.openCreateModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <form method="POST" action="{{ route('playlist.store') }}">
                <div class="bg-[#f1f8fc] border-2 border-primary rounded-md shadow-lg p-10 relative w-[600px] h-[320px]">
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
    </div>


    <!-- Tombol Input Artis -->
    <a href="{{ route('user.inputartis') }}"
        class="flex items-center justify-start h-[40px] min-w-[150px] px-4 rounded-md 
                {{ request()->routeIs('user.inputartis') ? 'bg-[#b4d1ed] shadow-md' : 'bg-[#95B7E4]' }} 
                text-white text-sm font-medium hover:bg-[#b4d1ed] transition-colors duration-200 flex-shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path
                d="M12 4C13.0609 4 14.0783 4.42143 14.8284 5.17157C15.5786 5.92172 16 6.93913 16 8C16 9.06087 15.5786 10.0783 14.8284 10.8284C14.0783 11.5786 13.0609 12 12 12C10.9391 12 9.92172 11.5786 9.17157 10.8284C8.42143 10.0783 8 9.06087 8 8C8 6.93913 8.42143 5.92172 9.17157 5.17157C9.92172 4.42143 10.9391 4 12 4ZM12 14C16.42 14 20 15.79 20 18V20H4V18C4 15.79 7.58 14 12 14Z"
                fill="#EBEDEC" />
        </svg>
        Input Artis
    </a>

    <!-- Tombol Input Lagu -->
    <a href="{{ route('user.inputlagu') }}"
        class="flex items-center justify-start h-[40px] min-w-[150px] px-4 rounded-md 
                {{ request()->routeIs('user.inputlagu') ? 'bg-[#b4d1ed] shadow-md' : 'bg-[#95B7E4]' }} 
                text-white text-sm font-medium hover:bg-[#b4d1ed] transition-colors duration-200 flex-shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <mask id="mask0_923_5608" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24"
                height="24">
                <rect width="24" height="24" fill="#D9D9D9" />
            </mask>
            <g mask="url(#mask0_923_5608)">
                <path
                    d="M10 21C8.9 21 7.95833 20.6083 7.175 19.825C6.39167 19.0417 6 18.1 6 17C6 15.9 6.39167 14.9583 7.175 14.175C7.95833 13.3917 8.9 13 10 13C10.3833 13 10.7375 13.0458 11.0625 13.1375C11.3875 13.2292 11.7 13.3667 12 13.55V3H18V7H14V17C14 18.1 13.6083 19.0417 12.825 19.825C12.0417 20.6083 11.1 21 10 21Z"
                    fill="#EBEDEC" />
            </g>
        </svg>
        Input Lagu
    </a>

    <hr class="my-4 border-t-2 border-white opacity-60">

    <!-- Musik yang disukai -->
    <a href="{{ route('user.favorite') }}">
        <div
            class="flex items-center h-[50px] px-4 rounded-md bg-[#95B7E4] text-white
            {{ request()->routeIs('user.favorite') ? 'bg-[#b4d1ed] shadow-md' : 'bg-[#95B7E4]' }}
                text-white hover:bg-[#b4d1ed] transition-colors duration-200">
            <svg class="w-5 h-5 mr-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                    clip-rule="evenodd"></path>
            </svg>
            <div>
                <div class="font-medium">Musik yang disukai</div>
                <div class="text-xs opacity-80" id="likedSongsCount">0 lagu</div>
            </div>
        </div>
    </a>

    <!-- Playlist Section -->
    <h2 class="mb-3 font-medium text-white">Playlist</h2>
    <x-secondary-button @click="$store.modalStore.openCreateModal = true"
        class="flex items-center justify-center gap-2 w-full h-[40px] text-md py-2 mt-2">
        <img src="{{ asset('img/add.png') }}" alt="Icon" style="max-width: 24px; max-height: 24px;" />
        {{ __('Tambah Playlist') }}
    </x-secondary-button>

    <div id="playlistContainer" class="space-y-3">
        @foreach ($playlists ?? [] as $playlist)
            <a href="{{ route('user.playlist', ['id' => $playlist['id']]) }}"
                class="flex items-center h-[50px] px-4 rounded-md
                   {{ ($selectedId ?? '') == $playlist['id'] ? 'bg-[#b4d1ed] shadow-md' : 'bg-[#95B7E4]' }}
                   text-white hover:bg-[#b4d1ed] transition-colors duration-200">
                <div class="flex items-center justify-center w-6 h-6 mr-3 rounded-md bg-white/20">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z">
                        </path>
                    </svg>
                </div>
                <div>
                    <div class="font-medium">{{ $playlist['name'] }}</div>
                    <div class="text-xs opacity-80">{{ $playlist['song_count'] }} lagu</div>
                </div>
            </a>
        @endforeach
    </div>

</div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Fungsi untuk mengambil dan menampilkan playlist dari API
        async function fetchAndDisplayPlaylists() {
            // URL API dari screenshot Postman Anda
            const apiUrl =
                'https://57a4-2001-448a-5001-20d3-556c-7f5c-5957-8be4.ngrok-free.app/playlists/list';
            const container = document.getElementById('playlistContainer');
            // Mengambil Bearer Token yang disimpan di session oleh Laravel
            const bearerToken = "{{ session('token') }}";

            // Jika tidak ada token, hentikan proses
            if (!bearerToken) {
                container.innerHTML =
                    '<p class="text-white text-xs text-center opacity-80">Harap login terlebih dahulu.</p>';
                return;
            }

            try {
                container.innerHTML =
                    '<p class="text-white text-xs text-center opacity-80">Memuat playlist...</p>';

                const response = await fetch(apiUrl, {
                    headers: {
                        'Authorization': `Bearer ${bearerToken}`,
                        'Accept': 'application/json',
                        'ngrok-skip-browser-warning': 'true' // Header untuk bypass warning ngrok
                    }
                });

                if (!response.ok) {
                    throw new Error(`Gagal memuat playlist. Status: ${response.status}`);
                }

                const playlists = await response.json();

                // Pastikan data adalah array
                if (!Array.isArray(playlists)) {
                    throw new Error('Format data API tidak valid.');
                }

                container.innerHTML = ''; // Kosongkan container sebelum mengisi

                if (playlists.length === 0) {
                    container.innerHTML =
                        '<p class="text-white text-xs text-center opacity-80">Belum ada playlist.</p>';
                    return;
                }

                // Loop melalui setiap playlist dan buat elemen HTML-nya
                playlists.forEach(playlist => {
                    const songCount = playlist.song_count || 0;

                    // Cek apakah URL saat ini cocok dengan ID playlist untuk menandai sebagai aktif
                    const currentPlaylistId = window.location.pathname.split('/').pop();
                    const isActive = currentPlaylistId === playlist.id;
                    const bgClass = isActive ? 'bg-[#b4d1ed] shadow-md' : 'bg-[#95B7E4]';

                    const playlistLink = document.createElement('a');
                    // Mengarahkan ke route 'user.playlist' dengan parameter id
                    playlistLink.href = `{{ url('/user/playlist') }}/${playlist.id}`;
                    playlistLink.className =
                        `flex items-center h-[50px] px-4 rounded-md ${bgClass} text-white hover:bg-[#b4d1ed] transition-colors duration-200`;

                    playlistLink.innerHTML = `
                        <div class="w-6 h-6 bg-white/20 rounded-md flex items-center justify-center mr-3">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"></path>
                            </svg>
                        </div>
                        <div>
                           <div class="font-medium truncate max-w-[150px]">${playlist.name}</div>
                            <div class="text-xs opacity-80">${songCount} lagu</div>
                        </div>
                    `;

                    container.appendChild(playlistLink);
                });

            } catch (error) {
                console.error('Error fetching playlists:', error);
                container.innerHTML = `<p class="text-red-300 text-xs text-center">${error.message}</p>`;
            }
        }

        // Panggil fungsi untuk memuat data
        fetchAndDisplayPlaylists();
    });

    document.addEventListener('DOMContentLoaded', function() {
        updateLikedSongsCount();
    });

    document.addEventListener('alpine:init', () => {
        Alpine.store('modalStore', {
            openCreateModal: false, // untuk kontrol modal create
            selected: [], // inisialisasi agar toggleSelected bekerja
            playlists: [], // agar isPlaylistEmpty tidak error
            toggleSelected(playlist) {
                if (this.selected.includes(playlist)) {
                    this.selected = this.selected.filter(i => i !== playlist);
                } else {
                    this.selected.push(playlist);
                }
            },
            saveSelection() {
                console.log('Selected playlists:', this.selected);
                this.openCreateModal = false;
            },
            isPlaylistEmpty() {
                return this.playlists.length === 0;
            }
        });
    });
</script>
