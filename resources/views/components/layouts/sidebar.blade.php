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
        <a href="{{ route('dashboard') }}"
            @class(['border py-2 text-white text-center rounded-2xl text-xl font-medium',
                    'border-lime-400' => $isActive,
                    'border-transparent' => !$isActive
            ])>
            Dashboard
        </a>

        <x-ui.nav-group menu-id="management-menu"
                        label="Management"
                        :items="['Member Management' => 'manage-members',
                                 'Squad Management' => 'manage-squads',
                                 'Team Management' => 'manage-teams',
                                 'Promote Members' => 'promoting-members',
                                 'Ban Lists' => 'ban-lists']">
        </x-ui.nav-group>

    </x-layouts.sidebar-nav>

</aside>
