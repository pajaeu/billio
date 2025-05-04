<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $title
 * @property bool $show_header
 * @property bool $show_installation_row
 * @property bool $show_account_number
 * @property bool $show_qr_payment
 * @property float $total
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection<int, InvoiceItem> $items
 */
final class Invoice extends Model
{
    protected $casts = [
        'show_header' => 'boolean',
        'show_installation_row' => 'boolean',
        'show_account_number' => 'boolean',
        'show_qr_payment' => 'boolean',
    ];

    /**
     * @return HasMany<InvoiceItem, covariant $this>
     */
    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

	public function qrPaymentSrc(): string
	{
		return sprintf('https://api.paylibo.com/paylibo/generator/czech/image?accountPrefix=107&accountNumber=4782730267&bankCode=0100&amount=%d&currency=CZK', $this->total);
	}
}
