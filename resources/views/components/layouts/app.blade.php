<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Headquarter | Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-800 flex flex-row min-h-screen text-white">

<x-layouts.sidebar/>
<main class="flex-1">{{$slot}}</main>

</body>
</html>
