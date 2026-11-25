@props([
    'title' => 'Dashboard'
])

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Headquarter | {{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black flex flex-row min-h-screen text-white">

<x-layouts.sidebar/>

<div class="flex-1 min-w-0 flex flex-col">
    <x-layouts.navbar :username="auth()->user()->name"/>
    <main class="flex-1">{{$slot}}</main>
</div>

</body>
</html>
