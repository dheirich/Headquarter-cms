@props([
    'username' => 'anonymous'
])

<nav class="flex-1 flex flex-col lg:flex-row shrink-0 bg-zinc-950 max-h-20 items-center px-4">
    <div class="w-full">
        <span>Welcome, {{ $username }}</span>
    </div>
    <div class="w-64">
        <form method="POST" action="{{ route('auth.logout') }}">
            @csrf
            <x-ui.button type="submit" variant="secondary">Logout</x-ui.button>
        </form>
    </div>
</nav>
