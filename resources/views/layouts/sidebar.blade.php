<!-- Sidebar -->
<div class="fixed top-16 inset-y-0 left-0 z-40 w-[240px] bg-[#7B9CD9] hidden lg:block shadow-[4px_0_8px_rgba(0,0,0,0.3)]"
    x-data>

    <div class="flex flex-col h-full pt-10 p-4 space-y-3 overflow-y-auto font-inter font-medium text-sm">
        <div x-cloak x-show="$store.modalStore.openCreateModal"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-[#f1f8fc] border-2 border-primary rounded-md shadow-lg p-10 relative w-[600px] h-[320px]">
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
        <!-- Tombol Input Artis -->
        <a href="{{ route('user.inputartis') }}"
            class="flex items-center h-[36px] px-4 rounded-md 
                {{ request()->routeIs('user.inputartis') ? 'bg-[#b4d1ed] shadow-md' : 'bg-[#95B7E4]' }} 
                text-white  hover:bg-[#b4d1ed] transition-colors duration-200">
            <img src="img/inputartis.png" alt="Icon" class="mr-1.5" style="max-width: 24px; max-height: 24px;" />
            Input Artis
        </a>

        <!-- Tombol Input Lagu -->
        <a href="{{ route('user.inputlagu') }}"
            class="flex items-center h-[36px] px-4 rounded-md 
        {{ request()->routeIs('user.inputlagu') ? 'bg-[#b4d1ed] shadow-md' : 'bg-[#95B7E4]' }} 
        text-white hover:bg-[#b4d1ed] transition-colors duration-200">
            <img src="img/inputlagu.png" alt="Icon" class="mr-1.5" style="max-width: 24px; max-height: 24px;" />
            Input Lagu
        </a>

        <hr class="my-4 border-t-2 border-white opacity-60">

        <!-- Musik yang disukai -->
        <a href="{{ route('user.favorite') }}">
            <div
                class="flex items-center h-[50px] px-4 rounded-md bg-[#95B7E4] text-white
            {{ request()->routeIs('user.favorite') ? 'bg-[#b4d1ed] shadow-md' : 'bg-[#95B7E4]' }} 
                text-white hover:bg-[#b4d1ed] transition-colors duration-200">
                <svg class="w-5 h-5 text-white mr-3" fill="currentColor" viewBox="0 0 20 20">
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
        <h2 class="text-white font-medium mb-3">Playlist</h2>
        @php
            $playlists = [
                ['id' => 1, 'name' => 'Calm', 'songCount' => 5],
                ['id' => 2, 'name' => 'Sad', 'songCount' => 10],
                ['id' => 3, 'name' => 'Happy', 'songCount' => 99],
            ];
            $selectedId = request()->query('id');
        @endphp

        <div id="playlistContainer" class="space-y-3">
            @foreach ($playlists as $playlist)
                <a href="{{ route('user.playlist', ['id' => $playlist['id']]) }}"
                    class="flex items-center h-[50px] px-4 rounded-md
                        {{ $selectedId == $playlist['id'] ? 'bg-[#b4d1ed] shadow-md' : 'bg-[#95B7E4]' }}
                        text-white hover:bg-[#b4d1ed] transition-colors duration-200">
                     <div class="w-6 h-6 bg-white/20 rounded-md flex items-center justify-center mr-3">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"></path>
                        </svg>
                    </div>
                    <div>
                       <div class="font-medium">{{ $playlist['name'] }}</div>
                        <div class="text-xs opacity-80">{{ $playlist['songCount'] }} lagu</div>
                    </div>
                </a>
            @endforeach
        </div>
        <x-secondary-button @click="$store.modalStore.openCreateModal = true"
            class="flex items-center justify-center gap-2 w-full h-[40px] text-md py-2 mt-2">
            <img src="/img/add.png" alt="Icon" style="max-width: 24px; max-height: 24px;" />
            {{ __('Tambah Playlist') }}
        </x-secondary-button>
    </div>
</div>

<script>
    function renderPlaylists() {
        const container = document.getElementById('playlistContainer');
        container.innerHTML = '';

        playlists.forEach(playlist => {
            const playlistElement = document.createElement('div');
            playlistElement.className =
                'flex items-center h-[50px] px-4 rounded-md bg-[#95B7E4] text-white hover:bg-[#b4d1ed] transition-colors duration-200 cursor-pointer';
            playlistElement.innerHTML = `
                <div class="flex items-center">
                    <div class="w-6 h-6 bg-white/20 rounded-md flex items-center justify-center mr-3">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.369 4.369 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium">${playlist.name}</div>
                        <div class="text-xs opacity-80">${playlist.songCount} lagu</div>
                    </div>
                </div>
            `;
            container.appendChild(playlistElement);
        });
    }

    function updateLikedSongsCount() {
        const el = document.getElementById('likedSongsCount');
        if (el) el.textContent = `${likedSongs.length} lagu`;
    }

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
