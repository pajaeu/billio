<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $name
 * @property int $quantity
 * @property string $unit
 * @property float $unit_price
 * @property float $installation_price
 * @property float $total
 * @property int $invoice_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Invoice $invoice
 */
final class InvoiceItem extends Model
{
    /** @return BelongsTo<Invoice, covariant $this> */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}
