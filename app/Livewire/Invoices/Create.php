<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Livewire\Concerns\HasInvoiceSettings;
use App\Livewire\Concerns\HasItems;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

final class Create extends Component
{
    use HasInvoiceSettings;
    use HasItems;

    public function mount(): void
    {
        $this->addItem();
    }

    public function save(): void
    {
        $this->validateItems();
        $this->recalculateTotals();

        DB::transaction(function (): void {
            $invoice = Invoice::query()->create([
                'title' => $this->title ?? Str::random(10),
                'total' => $this->total,
                'show_header' => $this->show_header,
                'show_installation_row' => $this->show_installation_row,
                'show_account_number' => $this->show_account_number,
                'show_qr_payment' => $this->show_qr_payment,
            ]);

            $invoice->items()->createMany($this->items);

            $this->redirectRoute('invoices.index', navigate: true);
        });
    }

    public function render(): View
    {
        return view('livewire.invoices.create');
    }
}
