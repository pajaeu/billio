<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::group(['as' => 'social.', 'prefix' => 'social'], function () {
    Route::get('/auth/google/redirect', [App\Http\Controllers\SocialAuth\GoogleController::class, 'redirect'])->name('google.redirect');
    Route::get('/auth/google/callback', [App\Http\Controllers\SocialAuth\GoogleController::class, 'callback'])->name('google.callback');
});

Route::view('login', 'auth.login')->name('login')->middleware('guest');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', App\Livewire\Invoices\Index::class)->name('invoices.index');
    Route::get('/faktura', App\Livewire\Invoices\Create::class)->name('invoices.create');
    Route::get('/faktura/{invoice}', App\Livewire\Invoices\Edit::class)->name('invoices.edit');
    Route::get('/faktura/{invoice}/pdf', [App\Http\Controllers\InvoiceController::class, 'print'])->name('invoices.print');
    Route::get('/faktura/{invoice}/download', [App\Http\Controllers\InvoiceController::class, 'download'])->name('invoices.download');
});
