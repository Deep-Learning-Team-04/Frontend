@props(['disabled' => false])

@php
    $baseClass = 'font-inter border-gray-300 rounded-md shadow-sm';

    // Fokus hanya aktif saat tidak disabled, tanpa bg
    $focusClass = $disabled ? '' : 'focus:border-[#7B9CD9] focus:ring-[#7B9CD9]';

    // Background dan warna teks sesuai status disabled
    $disabledClass = $disabled
        ? 'bg-disabled text-[#ADB5AF]' //bg dan text dissabled
        : 'bg-white text-neu900'; //bg dan text true
@endphp

<input
    @disabled($disabled)
    {{ $attributes->merge(['class' => "$baseClass $focusClass $disabledClass"]) }}
/>
