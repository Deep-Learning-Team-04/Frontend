<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'bg-transparent border border-[#FDFDFD] text-[#FDFDFD] text-[14px] font-medium font-inter rounded hover:bg-[#6b86cd] hover:text-[#FDFDFD] transition'
]) }}>
    {{ $slot }}
</button>