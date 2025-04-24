<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $invoice->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="text-slate-900 p-10">
    @if($invoice->show_header)
        <div class="text-lg font-bold leading-tight mb-6">
            <span class="text-xl">EL-GAS</span><br/>
            Pavel Skrbel<br/>
            Opavská 284/94, Kravaře 747 21<br/>
            Tel: 604 539 141, e-mail: skrbel.pavel@seznam.cz
        </div>
    @endif
    <div class="text-lg mb-8">{{ $invoice->title }}</div>
    <div class="flex gap-2 text-sm font-bold items-center border-b-2 border-gray-200">
        <div class="w-10"></div>
        <div class="w-1/5 p-2">Materiál</div>
        <div class="w-28 p-2">Jednotka</div>
        <div class="w-1/5 p-2">Cena</div>
        @if($invoice->show_installation_row)
            <div class="w-1/6 p-2">Montáž</div>
        @endif
        <div class="flex-1 p-2 text-end">Celkem</div>
    </div>
    @foreach($invoice->items as $index => $item)
        <div class="flex gap-2 text-sm items-center">
            <div class="w-10 p-2">{{ $index + 1 }}</div>
            <div class="w-1/5 p-2">{{ $item->name }}</div>
            <div class="w-28 p-2">{{ $item->quantity }} {{ $item->unit }}</div>
            <div class="w-1/5 p-2">{{ number_format($item->unit_price, 2, ',', ' ') }} Kč</div>
            @if($invoice->show_installation_row)
                <div class="w-1/6 p-2">{{ number_format($item->installation_price, 2, ',', ' ') }} Kč</div>
            @endif
            <div class="flex-1 p-2 text-end">{{ number_format($item->total, 2, ',', ' ') }} Kč</div>
        </div>
    @endforeach
    <div class="ms-1/2 mt-12 text-end text-lg font-bold">
        <span class="me-10">Celkem k platbě:</span>
        <span>{{ number_format($invoice->total, 2, ',', ' ') }} Kč</span>
    </div>
</body>
</html>