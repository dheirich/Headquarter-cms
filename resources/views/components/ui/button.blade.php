@props([
    'variant' => 'primary',
])

@php
$baseClasses = 'w-full rounded-lg py-2 font-normal transition text-center';
    $classes = match($variant){
        'primary' => 'text-zinc-950 bg-sky-600',
        'secondary' => 'text-zinc-400 bg-blue-700',
        'danger' => 'text-white bg-red-500',
        'navigation' => 'text-white',
        default => 'text-zinc-950 hover:text-zinc-200 bg-white underline-offset-2'
    };
@endphp


<button
    {{$attributes->merge(['class' => $baseClasses .' ' . $classes ])}}>

    {{ $slot }}

</button>
