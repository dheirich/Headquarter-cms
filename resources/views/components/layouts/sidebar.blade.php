@php
    $isActive = request()->routeIs('dashboard');
@endphp

<aside class="w-64 shrink-0 flex flex-col bg-zinc-900">

    <div class="mt-8 w-full flex items-center flex-col gap-2 px-4  border-b border-white/10 pb-4">
        <x-ui.logo src="{{ asset('images/headquarter-emblem-vector.svg') }}" alt="CLANHQ Headdquarter Logo" />
        <span class="text-center text-white uppercase tracking-wide text-xl font-medium">Headquarter</span>
        <span class="text-center text-white/50 uppercase tracking-widest text-xs">Clan Management System</span>
    </div>

    <x-layouts.sidebar-nav>
        <a
            href="{{ route('dashboard') }}"
            @class(['border py-2 text-white text-center rounded-2xl text-xl font-medium',
                    'border-lime-400' => $isActive,
                    'border-transparent' => !$isActive
            ])>
            Dashboard
        </a>


            <div class="w-full py-6">
                <x-ui.button type="button" variant="navigation">Management</x-ui.button>

                <ul class="flex flex-col w-full text-center gap-2 text-sm mt-4">
                    <x-ui.link route-name="manage-members" variant="primary" href="{{ route('manage-members') }}">Member Management</x-ui.link>
                    <x-ui.link route-name="promoting-members" variant="secondary" href="{{ route('promoting-members') }}">Promoting Members</x-ui.link>
                    <x-ui.link route-name="ban-lists" variant="secondary" href="{{ route('ban-lists') }}">Ban Lists</x-ui.link>
                    <x-ui.link route-name="manage-squads" variant="secondary" href="{{ route('manage-squads') }}">Squad Management</x-ui.link>
                    <x-ui.link route-name="manage-teams" variant="secondary" href="{{ route('manage-teams') }}">Team Management</x-ui.link>
                </ul>
            </div>
    </x-layouts.sidebar-nav>

</aside>
