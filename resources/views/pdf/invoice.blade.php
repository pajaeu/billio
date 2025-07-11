<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $invoice->title }}</title>
    @vite(['resources/css/app.css'])
</head>
<body class="text-slate-900">
@if($invoice->show_header)
    <div class="text-lg font-bold leading-tight mb-6">
        <span class="text-xl">EL-GAS</span><br/>
        Pavel Skrbel<br/>
        Opavská 284/94, Kravaře 747 21<br/>
        Tel: 604 539 141, e-mail: skrbel.pavel@seznam.cz
    </div>
@endif
<div class="text-lg mb-8">
    <div>{{ $invoice->title }}</div>
    @if($invoice->show_account_number)
        <div class="mt-1 text-base">Číslo účtu: 107-4782730267/0100</div>
    @endif
</div>
<div class="flex gap-2 text-sm font-bold items-center border-b-2 border-gray-200">
    <div class="w-10"></div>
    <div class="@if($invoice->show_installation_row) w-1/5 @else w-1/3 @endif p-2">Materiál</div>
    <div class="@if($invoice->show_installation_row) w-28 @else w-32 @endif p-2">Jednotka</div>
    <div class="w-1/5 p-2">Cena</div>
    @if($invoice->show_installation_row)
        <div class="w-1/6 p-2">Montáž</div>
    @endif
    <div class="flex-1 p-2 text-end">Celkem</div>
</div>
@php($itemIndex = 1)
@foreach($invoice->items as $index => $item)
    <div class="flex gap-2 text-sm items-center">
        @if($item->is_heading)
            <div class="w-full px-2 py-1 font-semibold text-lg">{{ $item->name }}</div>
            @php($itemIndex = 1)
        @else
            <div class="w-10 px-2 py-1">{{ $itemIndex++ }}</div>
            <div class="@if($invoice->show_installation_row) w-1/5 @else w-1/3 @endif px-2 py-1">{{ $item->name }}</div>
            <div class="@if($invoice->show_installation_row) w-28 @else w-32 @endif px-2 py-1">{{ $item->quantity }} {{ $item->unit }}</div>
            <div class="w-1/5 px-2 py-1">{{ number_format($item->unit_price, 2, ',', ' ') }} Kč</div>
            @if($invoice->show_installation_row)
                <div class="w-1/6 px-2 py-1">{{ number_format($item->installation_price, 2, ',', ' ') }} Kč</div>
            @endif
            <div class="flex-1 px-2 py-1 text-end">{{ number_format($item->total, 2, ',', ' ') }} Kč</div>
        @endif
    </div>
@endforeach
<div class="ms-1/2 mt-12 text-end text-lg font-bold">
    <span class="me-10">Celkem k platbě:</span>
    <span>{{ number_format($invoice->total, 2, ',', ' ') }} Kč</span>
</div>
@if($invoice->show_qr_payment)
    <div class="text-end mt-6">
        <p>Zaplaťte jednoduše pomocí QR kódu:</p>
        <img src="{{ $invoice->qrPaymentSrc() }}" alt="QR" class="ms-auto size-28">
    </div>
@endif
</body>
</html>