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
                    <label for="email" class="mb-2 block text-sm font-medium text-zinc-300">Email:</label>
                    <div class="w-full">
                        <input id="email" name="email" type="email"
                               class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-3 text-white outline-none focus:border-violet-400"
                               value="{{old('email')}}"
                               autocomplete="username" />
                    </div>
                    @error('email')
                        <p class="text-red-200 bg-red-800 px-4 py-2 border border-white/10 w-full text-center mt-2">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block text-sm font-medium text-zinc-300">Password:</label>
                    <div class="w-full">
                        <input id="password" name="password" type="password"
                               class="w-full rounded-lg border border-white/15 bg-white/10 px-4 py-3 text-white outline-none focus:border-violet-400"
                               autocomplete="current-password"/>
                    </div>
                    @error('password')
                        <p class="text-red-200 bg-red-800 px-4 py-2 border border-white/10 w-full text-center mt-2">{{$message}}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <button class="w-full rounded-lg bg-white px-4 py-3 font-semibold text-zinc-950 transition-colors hover:bg-zinc-200"
                            type="submit">
                        Login
                    </button>
                </div>
            </form>

        </div>

    </div>

</main>
</body>
</html>
