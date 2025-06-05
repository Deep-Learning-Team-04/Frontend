<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => '
        bg-[#7B9CD9] text-[#FDFDFD] text-[14px]
        font-medium font-inter rounded px-3 py-1
        border border-[#7B9CD9]
        hover:bg-[#516ab1] hover:text-[#FDFDFD]
        transition duration-200
    '
]) }}>
    {{ $slot }}
</button>
