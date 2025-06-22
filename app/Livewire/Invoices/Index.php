<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Models\Invoice;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

final class Index extends Component
{
    use WithPagination;

    public function copy(int $id): void
    {
        $invoice = Invoice::query()->with('items')->findOrFail($id);

        $newInvoice = $invoice->replicate();
        $newInvoice->title = $newInvoice->title.' copy';
        $newInvoice->save();

        foreach ($invoice->items as $item) {
            $newItem = $item->replicate();
            $newItem->invoice_id = $newInvoice->id;
            $newItem->save();
        }
    }

    public function delete(int $id): void
    {
        $invoice = Invoice::query()->findOrFail($id);

        $invoice->delete();
    }

    public function render(): View
    {
        return view('livewire.invoices.index', [
            'invoices' => Invoice::query()->latest()->paginate(24),
        ]);
    }
}
