<!-- Sidebar -->
<div class="fixed top-16 inset-y-0 left-0 z-40 w-[240px] bg-[#7B9CD9] hidden lg:block shadow-[4px_0_8px_rgba(0,0,0,0.3)]">
   <div class="flex flex-col h-full pt-10 p-4 space-y-3 overflow-y-auto font-inter font-medium text-sm">

        <!-- Tombol Input Artis -->
       <a href="{{ route('admin.inputartis') }}"
            class="flex items-center h-[36px] px-4 rounded-md 
                    {{ request()->routeIs('admin.inputartis') ? 'bg-[#b4d1ed] shadow-md' : 'bg-[#95B7E4]' }} 
                    text-white  hover:bg-[#b4d1ed] transition-colors duration-200">
                    <img src="img/inputartis.png" alt="Icon" class="mr-1.5" style="max-width: 24px; max-height: 24px;" />
                    Input Artis
        </a>

        <!-- Tombol Input Lagu -->
        <a href="{{ route('admin.inputlagu') }}"
            class="flex items-center h-[36px] px-4 rounded-md 
                    {{ request()->routeIs('admin.inputlagu') ? 'bg-[#b4d1ed] shadow-md' : 'bg-[#95B7E4]' }} 
                    text-white hover:bg-[#b4d1ed] transition-colors duration-200">
                    <img src="img/inputlagu.png" alt="Icon" class="mr-1.5" style="max-width: 24px; max-height: 24px;" />
                    Input Lagu
        </a>


    </div>
</div>
