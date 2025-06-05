@props(['disabled' => false])

<input 
    @disabled($disabled) 
    {{ $attributes->merge([
        'class' => 'border-gray-300 focus:border-[#7B9CD9] focus:ring-[#7B9CD9] rounded-md shadow-sm placeholder:text-gray-400'
    ]) }} 
/>

