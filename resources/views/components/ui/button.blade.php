@props([
    'variant' => 'primary',
])

@php
$baseClasses = 'w-full rounded-lg py-2 font-medium text-xl transition text-center';
    $classes = match($variant){
        'primary' => 'text-white bg-sky-600 hover:bg-sky-500 hover:text-black/30',
        'secondary' => 'bg-zinc-900 text-white font-normal border-1 border-white hover:bg-zinc-800',
        'danger' => 'text-white bg-red-500',
        'navigation' => 'text-white',
        default => 'text-zinc-950 hover:text-zinc-200 bg-white underline-offset-2'
    };
@endphp


<button
    {{$attributes->merge(['class' => $baseClasses .' ' . $classes ])}}>

    {{ $slot }}

</button>
