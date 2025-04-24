<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Billio - jednoduchá fakturace pro elektrikáře</title>
    @vite(['resources/js/app.js'])
</head>
<body class="text-slate-800 bg-slate-50">
<main class="mx-auto max-w-[1100px]">{{ $slot }}</main>
<div class="p-4 text-center text-slate-500 text-sm">
    Vytvořil Pavel Skrbel | verze 2.0
</div>
</body>
</html>