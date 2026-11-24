@props([
    'variant' => 'primary',
    'href' => '#'
])

@php
    $baseClasses = 'w-full border-b border-b-taupe-200/20 hover:text-cyan-400/50 transition duration-200';
    $variantClasses = match($variant){
        'primary' => 'border-t border-t-taupe-200/20 font-normal',
        'secondary' => 'border border-taupe-200/20 font-semibold',
        default => ''
    };
@endphp

<li {{ $attributes->merge(['class' => trim($baseClasses . ' ' . $variantClasses)]) }}><a href="{{$href}}" class="block w-full py-2 ">{{ $slot }}</a></li>
