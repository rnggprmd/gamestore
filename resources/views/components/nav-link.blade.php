@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-watt-cyan text-sm font-medium leading-5 text-white focus:outline-none focus:border-watt-cyan transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-watt-text-sec hover:text-white hover:border-watt-border focus:outline-none focus:text-white focus:border-watt-border transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
