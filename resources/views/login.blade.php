<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClanIntern | Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<main class="grid min-h-screen place-items-center bg-zinc-950 px-4 py-8 text-white
        bg-[radial-gradient(ellipse_at_top_left,rgba(109,40,217,0.25),transparent_45%),radial-gradient(ellipse_at_bottom_right,rgba(8,145,178,0.15),transparent_45%)]">

    <div class="w-full max-w-lg rounded-2xl border border-white/10 bg-white/10 p-6 shadow-2xl backdrop-blur-xl sm:max-w-lg sm:p-10 lg:max-w-xl">

        <div class="mb-4 flex flex-col items-center gap-4">

            <div class="flex items-center justify-center gap-3">
                <img src="/images/headquarter-emblem-vector.svg"
                     alt="Headquarter Logo"
                     class="h-16 w-16 object-contain shrink-0 sm:h-20 sm:w-20 lg:h-24 lg:w-24"/>

                <h1 class="text-2xl font-bold tracking-wider text-white sm:text-3xl lg:text-4xl">
                    Headquarter
                </h1>
            </div>

            <p class="text-2xl text-zinc-400">
                Please log in
            </p>

            <form class="mx-auto w-full max-w-md" method="POST" action="{{ route('auth.login') }}">
                @csrf

                <div class="mb-5">
                    <x-ui.label for="email">Email:</x-ui.label>

                    <div class="w-full">
                        <x-ui.input type="email" name="email" id="email" autocomplete="username" value="{{old('email')}}"/>
                    </div>

                    <x-ui.form-error field="email" />
                </div>

                <div class="mb-5">
                    <x-ui.label for="password">Password:</x-ui.label>

                    <div class="w-full">
                        <x-ui.input type="password" name="password" id="password" autocomplete="current-password"/>
                    </div>

                    <x-ui.form-error field="password" />
                </div>

                <div class="mt-4">
                    <x-ui.button type="submit">Login</x-ui.button>
                </div>
            </form>

        </div>

    </div>

</main>
</body>
</html>
