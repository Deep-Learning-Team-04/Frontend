<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'bg-[#FDFDFD] text-[#7B9CD9] text-[14px] font-medium font-inter rounded px-3 py-1 hover:bg-[#d0e4f5] transition'
]) }}>
    {{ $slot }}
</button>