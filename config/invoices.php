<?php

declare(strict_types=1);

return [
    'account' => [
        'prefix' => env('INVOICE_ACCOUNT_PREFIX', '000'),
        'number' => env('INVOICE_ACCOUNT_NUMBER', '0000000000'),
        'code' => env('INVOICE_ACCOUNT_CODE', '0000'),
    ],
];
