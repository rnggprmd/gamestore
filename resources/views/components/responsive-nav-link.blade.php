@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-watt-cyan text-start text-base font-medium text-watt-cyan bg-watt-cyan/10 focus:outline-none focus:text-watt-cyan focus:bg-watt-cyan/20 focus:border-watt-cyan transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-watt-text-sec hover:text-white hover:bg-watt-hover hover:border-watt-border focus:outline-none focus:text-white focus:bg-watt-hover focus:border-watt-border transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
