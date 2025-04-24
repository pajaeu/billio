<div class="rounded shadow bg-white">
    <div class="p-6 md:p-12 flex items-center border-b border-slate-200">
        <h1 class="text-2xl font-semibold">Faktura číslo {{ $invoice->id }}</h1>
        <a href="{{ route('invoices.index') }}" wire:navigate class="ms-auto cursor-pointer py-2 px-2.5 flex gap-1 items-center rounded text-sm font-semibold border border-slate-200 hover:bg-slate-50 hover:border-slate-300 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path fill-rule="evenodd" d="M9.78 4.22a.75.75 0 0 1 0 1.06L7.06 8l2.72 2.72a.75.75 0 1 1-1.06 1.06L5.47 8.53a.75.75 0 0 1 0-1.06l3.25-3.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
            </svg>
            <span>Zpět</span>
        </a>
    </div>
    @include('partials.invoice.form')
</div>