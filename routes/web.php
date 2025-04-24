<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get('/', App\Livewire\Invoices\Index::class)->name('invoices.index');
Route::get('/faktura', App\Livewire\Invoices\Create::class)->name('invoices.create');
Route::get('/faktura/{invoice}', App\Livewire\Invoices\Edit::class)->name('invoices.edit');
Route::get('/faktura/{invoice}/pdf', [App\Http\Controllers\InvoiceController::class, 'print'])->name('invoices.print');
Route::get('/faktura/{invoice}/download', [App\Http\Controllers\InvoiceController::class, 'download'])->name('invoices.download');
