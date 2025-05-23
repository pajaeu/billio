<?php

declare(strict_types=1);

namespace App\Livewire\Concerns;

use Livewire\Attributes\Locked;

trait HasItems
{
    /**
     * @var array<int, array{
     *     id: ?int,
     *     name: string,
     *     quantity: string|int,
     *     unit: string,
     *     unit_price: string|float,
     *     installation_price: string|float,
     *     total: float,
     *     is_heading: bool
     * }>
     */
    public array $items = [];

    #[Locked]
    public float $total;

    public function updatedItems(): void
    {
        $this->recalculateTotals();
    }

    public function addItem(): void
    {
        $this->items[] = [
            'id' => null,
            'name' => '',
            'quantity' => 1,
            'unit' => '',
            'unit_price' => 0,
            'installation_price' => 0,
            'total' => 0,
            'is_heading' => false,
        ];

        $this->recalculateTotals();
    }

    public function addHeading(): void
    {
        $this->items[] = [
            'id' => null,
            'name' => '',
            'quantity' => 1,
            'unit' => 'ks',
            'unit_price' => 0,
            'installation_price' => 0,
            'total' => 0,
            'is_heading' => true,
        ];
    }

    public function removeItem(int $index): void
    {
        unset($this->items[$index]);

        $this->items = array_values($this->items);

        $this->recalculateTotals();

        $this->resetValidation('items.*');
    }

    /**
     * @param  array<int, int>  $orders
     */
    public function updateItemOrder(array $orders): void
    {
        $reorderedItems = [];

        foreach ($orders as $position => $index) {
            if (! isset($this->items[$index])) {
                continue;
            }

            $reorderedItems[$position] = $this->items[$index];
        }

        ksort($reorderedItems);

        $this->items = array_values($reorderedItems);

        $this->resetValidation('items.*');
    }

    private function recalculateTotals(): void
    {
        $items = collect($this->items)->map(function (array $item): array {
            $quantity = (int) $item['quantity'];
            $unitPrice = (float) $item['unit_price'];
            $installationPrice = (float) $item['installation_price'];

            $item['total'] = $quantity * ($unitPrice + $installationPrice);

            return $item;
        });

        $total = $items->sum('total');

        $this->items = $items->all();

        $this->total = is_numeric($total) ? (float) $total : 0.0;
    }

    private function validateItems(): void
    {
        $this->validate([
            'items.*.name' => 'required|string',
            'items.*.quantity' => 'required|integer',
            'items.*.unit' => 'required|string',
            'items.*.unit_price' => 'required|numeric',
            'items.*.installation_price' => 'required|numeric',
        ]);
    }
}
