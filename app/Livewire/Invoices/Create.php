<?php

declare(strict_types=1);

namespace App\Livewire\Invoices;

use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

final class Create extends Component
{
    /**
     * @var array<int, array{
     *     name: string,
     *     quantity: int,
     *     unit: string,
     *     unit_price: float,
     *     installation_price: float,
     *     total: float,
     *     position: int
     * }>
     */
    public array $items = [];

    #[Locked]
    public float $total;

    public function mount(): void
    {
        $this->addItem();
    }

    public function updatedItems(): void
    {
        $this->recalculateTotals();
    }

    /**
     * @param  array<int, int>  $orders
     */
    public function updateOrder(array $orders): void
    {
        foreach ($orders as $position => $index) {
            $this->items[$index]['position'] = $position + 1;
        }
    }

    public function addItem(): void
    {
        $this->items[] = [
            'name' => '',
            'quantity' => 1,
            'unit' => '',
            'unit_price' => 0,
            'installation_price' => 0,
            'total' => 0,
            'position' => count($this->items) + 1,
        ];

        $this->recalculateTotals();
    }

    public function removeItem(int $index): void
    {
        unset($this->items[$index]);

        $this->recalculateTotals();
    }

    public function save(): void
    {
        DB::transaction(function (): void {
            $invoice = Invoice::create([
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

    private function recalculateTotals(): void
    {
        $this->items = collect($this->items)->map(function (array $item): array {
            $quantity = (int) $item['quantity'];
            $unitPrice = (float) $item['unit_price'];
            $installationPrice = (float) $item['installation_price'];

            $item['total'] = $quantity * ($unitPrice + $installationPrice);

            return $item;
        })->all();

        $this->total = array_sum(array_column($this->items, 'total'));
    }
}
