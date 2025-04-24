<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
