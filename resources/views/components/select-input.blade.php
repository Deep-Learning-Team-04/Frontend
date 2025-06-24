@props(['disabled' => false])

@php
    $baseClass = 'font-inter border-gray-300 rounded-md shadow-sm px-3 py-2 text-sm';

    $focusClass = $disabled ? '' : 'focus:border-[#7B9CD9] focus:ring-[#7B9CD9]';

    $disabledClass = $disabled
        ? 'bg-disabled text-[#ADB5AF] cursor-not-allowed'
        : 'bg-white text-neu900';
@endphp

<select
    @disabled($disabled)
    {{ $attributes->merge(['class' => "$baseClass $focusClass $disabledClass w-full"]) }}
>
    {{ $slot }}
</select>
