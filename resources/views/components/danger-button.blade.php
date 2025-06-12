<button {{ $attributes->merge([
    'type' => 'button',
    'class' => 'bg-[#FFF1F1] text-[#F83B3E] text-[18px] font-medium font-inter rounded px-3 py-1 hover:bg-[#ffe1e2] transition'
]) }}>
    {{ $slot }}
</button>