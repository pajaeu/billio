<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Livewire\Concerns\HasInvoiceSettings;
use App\Livewire\Concerns\HasItems;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

final class Edit extends Component
{
    use HasInvoiceSettings;
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
            'is_heading' => $item->is_heading ?? false,
        ])->all();
        $this->title = $invoice->title;
        $this->show_header = $invoice->show_header;
        $this->show_installation_row = $invoice->show_installation_row;
        $this->show_account_number = $invoice->show_account_number;
        $this->show_qr_payment = $invoice->show_qr_payment;

        $this->recalculateTotals();
    }

    public function save(): void
    {
        $this->validateItems();
        $this->recalculateTotals();

        DB::transaction(function (): void {
            $this->invoice->items()->delete();

            $this->invoice->update([
                'title' => $this->title,
                'total' => $this->total,
                'show_header' => $this->show_header,
                'show_installation_row' => $this->show_installation_row,
                'show_account_number' => $this->show_account_number,
                'show_qr_payment' => $this->show_qr_payment,
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
