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
                <button type="submit" class="cursor-pointer py-2 px-4 flex items-center gap-2 rounded border border-slate-200 hover:text-slate-800 hover:border-white hover:bg-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd" d="M17 4.25A2.25 2.25 0 0 0 14.75 2h-5.5A2.25 2.25 0 0 0 7 4.25v2a.75.75 0 0 0 1.5 0v-2a.75.75 0 0 1 .75-.75h5.5a.75.75 0 0 1 .75.75v11.5a.75.75 0 0 1-.75.75h-5.5a.75.75 0 0 1-.75-.75v-2a.75.75 0 0 0-1.5 0v2A2.25 2.25 0 0 0 9.25 18h5.5A2.25 2.25 0 0 0 17 15.75V4.25Z" clip-rule="evenodd" />
                        <path fill-rule="evenodd" d="M1 10a.75.75 0 0 1 .75-.75h9.546l-1.048-.943a.75.75 0 1 1 1.004-1.114l2.5 2.25a.75.75 0 0 1 0 1.114l-2.5 2.25a.75.75 0 1 1-1.004-1.114l1.048-.943H1.75A.75.75 0 0 1 1 10Z" clip-rule="evenodd" />
                    </svg>
                    <span>Odhlásit se</span>
                </button>
            </form>
        </div>
    </div>
@endauth
<main class="mx-auto max-w-[1100px]">{{ $slot }}</main>
<x-footer/>
</body>
</html>