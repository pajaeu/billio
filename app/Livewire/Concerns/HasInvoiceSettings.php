<?php

declare(strict_types=1);

namespace App\Livewire\Concerns;

trait HasInvoiceSettings
{
    public ?string $title = null;

    public bool $show_header = true;

    public bool $show_installation_row = true;

    public bool $show_account_number = false;

    public bool $show_qr_payment = false;
}
