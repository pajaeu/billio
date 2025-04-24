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
@auth
    <div class="py-6 mb-6 text-white shadow bg-blue-500">
        <div class="mx-auto max-w-[1100px] flex items-center">
            <a href="{{ url('/') }}" class="block">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10">
            </a>
            <form action="{{ route('logout') }}" method="post" class="ms-auto">
                @csrf
                <button type="submit" class="cursor-pointer py-2 px-4 rounded border border-slate-200 hover:text-slate-800 hover:border-white hover:bg-white transition-colors">Odhlásit se</button>
            </form>
        </div>
    </div>
@endauth
<main class="mx-auto max-w-[1100px]">{{ $slot }}</main>
<x-footer/>
</body>
</html>