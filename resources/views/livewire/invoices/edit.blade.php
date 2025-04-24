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
    <div class="p-6 md:p-12">
        <div class="flex gap-2 mb-2 text-sm font-semibold items-center">
            <div class="w-10"></div>
            <div class="w-1/4">
                Materiál
            </div>
            <div class="w-16">
                Počet
            </div>
            <div class="w-20">
                Jednotka
            </div>
            <div class="w-1/6">
                Cena
            </div>
            <div class="w-1/6">
                Montáž
            </div>
            <div class="flex-1">
                Celkem
            </div>
            <div class="w-8"></div>
        </div>
        <div x-data="{
            init() {
                const el = this.$el;
                new Sortable(el, {
                    animation: 150,
                    handle: '.handle',
                    onEnd: (evt) => {
                        const newOrder = Array.from(el.children)
                            .map(child => child.getAttribute('data-id'));
                        @this.call('updateItemOrder', newOrder);
                    }
                });
            }
        }">
            @foreach ($items as $index => $item)
                <div wire:key="item_{{ $index }}" class="flex gap-2 mb-2 items-center" data-id="{{ $index }}">
                    <div class="w-10">
                        <button class="cursor-move text-slate-300 hover:text-slate-500 transition-colors handle">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                            </svg>
                        </button>
                    </div>
                    <div class="w-1/4 border @error('items.' . $index . '.name') border-red-500 @else border-slate-300 @enderror rounded">
                        <input type="text" wire:model="items.{{ $index }}.name" placeholder="Materiál" class="w-full p-2 outline-none">
                    </div>
                    <div class="w-16 border @error('items.' . $index . '.quantity') border-red-500 @else border-slate-300 @enderror rounded">
                        <input type="number" wire:model.live="items.{{ $index }}.quantity" class="w-full p-2 outline-none" placeholder="" min="1">
                    </div>
                    <div class="w-20 border @error('items.' . $index . '.unit') border-red-500 @else border-slate-300 @enderror rounded">
                        <input type="text" wire:model.live="items.{{ $index }}.unit" class="w-full p-2 outline-none" placeholder="ks">
                    </div>
                    <div class="w-1/6 border @error('items.' . $index . '.unit_price') border-red-500 @else border-slate-300 @enderror rounded">
                        <input type="number" step="0.01" wire:model.live="items.{{ $index }}.unit_price" class="w-full p-2 outline-none" placeholder="">
                    </div>
                    <div class="w-1/6 border @error('items.' . $index . '.installation_price') border-red-500 @else border-slate-300 @enderror rounded">
                        <input type="number" step="0.01" wire:model.live="items.{{ $index }}.installation_price" class="w-full p-2 outline-none" placeholder="">
                    </div>
                    <div class="flex-1 p-2 border border-slate-300 bg-slate-100 rounded">
                        <input type="hidden" wire:model="items.{{ $index }}.total">
                        <span>{{ number_format((float) $item['total'], decimals: 2, decimal_separator: ',', thousands_separator: ' ') }} Kč</span>
                    </div>
                    <div class="w-8 flex items-center">
                        @if(count($items) > 1)
                            <button wire:click="removeItem({{ $index }})" class="cursor-pointer text-slate-300 hover:text-red-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        @else
                            <span class="cursor-not-allowed text-slate-200">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <button wire:click="addItem" class="mt-4 cursor-pointer py-2 px-2.5 flex gap-1 items-center rounded text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
            </svg>
            <span>Přidat položku</span>
        </button>
        <div class="my-6 p-6 rounded bg-slate-50 text-lg text-end">
            <span class="text-lg text-slate-500">Celkem k platbě:</span><span class="md:ms-2 text-2xl font-semibold">{{ number_format($total, decimals: 2, decimal_separator: ',', thousands_separator: ' ') }} Kč</span>
        </div>
        <div class="flex md:justify-end md:items-center">
            <button wire:click="save" class="cursor-pointer py-2 px-4 flex gap-2 items-center rounded font-semibold text-lg text-white bg-green-500 hover:bg-green-600 transition-colors">
                <span>Uložit</span>
            </button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>