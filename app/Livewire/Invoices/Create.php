<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Livewire\Concerns\HasItems;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

final class Create extends Component
{
    use HasItems;

    public function mount(): void
    {
        $this->addItem();
    }

    public function save(): void
    {
        $this->validateItems();

        DB::transaction(function (): void {
            $invoice = Invoice::query()->create([
                'title' => Str::random(10),
                'total' => $this->total,
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
