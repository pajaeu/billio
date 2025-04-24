<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Livewire\Concerns\HasItems;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

final class Edit extends Component
{
    use HasItems;

    #[Locked]
    public Invoice $invoice;

    public function mount(Invoice $invoice): void
    {
        $this->invoice = $invoice;
        $this->items = $invoice->items->map(fn ($item): array => [
            'id' => $item->id,
            'name' => $item->name,
            'quantity' => $item->quantity,
            'unit' => $item->unit,
            'unit_price' => $item->unit_price,
            'installation_price' => $item->installation_price,
            'total' => $item->total,
        ])->all();

        $this->recalculateTotals();
    }

    public function save(): void
    {
        $this->validateItems();
        $this->recalculateTotals();

        DB::transaction(function (): void {
            $this->invoice->items()->delete();

            $this->invoice->update([
                'total' => $this->total,
            ]);

            $this->invoice->items()->createMany($this->items);

            $this->redirectRoute('invoices.index', navigate: true);
        });
    }

    public function render(): View
    {
        return view('livewire.invoices.edit');
    }
}
