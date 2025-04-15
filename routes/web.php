<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Invoices\Index::class)->name('invoices.index');
Route::get('/faktura', App\Livewire\Invoices\Create::class)->name('invoices.create');
