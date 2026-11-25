@props([
    'menu-id',
    'label',
    'routes' => []
])

@php
    $isActiveRoutes = request()->routeIs($routes);
@endphp


<div class="w-full py-6" x-data="{ open: @json($isActiveRoutes) }">
    <x-ui.button
        type="button"
        variant="navigation"
        x-on:click="open = !open"
        x-bind:aria-expanded="open"
        aria-controls="{{ $menuId }}">
        {{ $label }}
    </x-ui.button>

    <ul class="flex flex-col w-full text-center gap-2 text-sm mt-4" id="{{ $menuId }}" x-show="open" x-transition x-cloak>
        {{ $slot }}
    </ul>
</div>
