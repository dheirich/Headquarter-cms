@props([
    'variant' => 'medium',
    'routeName'
])

@php
    $href = route($routeName);
    $isActive = request()->routeIs($routeName);

    $baseClasses = 'w-full first:border-t border-t-taupe-200/20 border-b border-b-taupe-200/20 hover:text-cyan-400/50 transition duration-200';
    $activeClasses = $isActive ? 'text-cyan-400' : 'text-white';
    $variantClasses = match($variant){
        'bold' => 'font-bold',
        'medium' => 'font-medium',
        default => 'font-normal'
    };
@endphp

<li {{ $attributes->merge(['class' => trim($baseClasses . ' ' . $variantClasses . ' ' . $activeClasses)]) }}><a href="{{ $href }}" class="block w-full py-2 ">{{ $slot }}</a></li>
