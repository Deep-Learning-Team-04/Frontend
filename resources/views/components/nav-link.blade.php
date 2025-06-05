@props(['active' => false, 'href' => null])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-white rounded-lg bg-[#2C698D] focus:outline-none hover:cursor-default'
            : 'flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-white rounded-lg hover:bg-gray-700 focus:outline-none hover:cursor-pointer';
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="button" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif