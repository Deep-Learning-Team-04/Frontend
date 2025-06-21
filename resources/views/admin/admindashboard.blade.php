<x-adminapp>
    {{-- Background --}}
    <style>
        body {
            background-color: #F9FAFB;
        }
    </style>

    {{-- Kontainer utama --}}
    <div class="w-full max-w-7xl px-6 mx-auto">
        {{-- Konten playlist --}}
        <section class="mt-6">
            <h1 class="font-roboto text-3xl font-semibold text-primary mb-4">Rekomendasi Playlist</h1>
            <div class="flex gap-4 overflow-x-auto pb-2">
                {{-- cards --}}
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

        {{-- Konten artis viral --}}
        <section class="mt-10">
            <h1 class="font-roboto text-3xl font-semibold text-primary mb-4">Artis Viral</h1>
            <div class="flex space-x-6 overflow-x-auto scrollbar-hide pb-2 items-center">
                {{-- Artis --}}
                <div class="flex-shrink-0 flex flex-col items-center w-28">
                    <img src="img/hero.png" alt="artist" class="w-28 h-28 rounded-full object-cover border-transparent hover:border-2 border-primary transition" />
                    <p class="mt-2 font-inter text-[16px] font-medium text-[#181B19] text-center w-28 break-words leading-tight line-clamp-2"> Stecu</p>
                </div>
            </div>
        </section>
    </div>
</x-adminapp>
