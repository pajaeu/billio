<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Models\Invoice;
use Illuminate\View\View;
use Livewire\Component;

final class Index extends Component
{
    public function delete(int $id): void
    {
        $invoice = Invoice::query()->findOrFail($id);

        $invoice->delete();
    }

    public function render(): View
    {
        return view('livewire.invoices.index', [
            'invoices' => Invoice::query()->latest()->paginate(12),
        ]);
    }
}
