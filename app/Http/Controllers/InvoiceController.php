<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Support\Str;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\LaravelPdf\PdfBuilder;

final class InvoiceController
{
    public function print(Invoice $invoice): PdfBuilder
    {
        return $this->getPdf($invoice);
    }

    public function download(Invoice $invoice): PdfBuilder
    {
        return $this->getPdf($invoice)
            ->download();
    }

    private function getPdf(Invoice $invoice): PdfBuilder
    {
        $name = implode('-', [
            $invoice->title,
            now()->format('d-m-Y'),
        ]);

        return Pdf::view('pdf.invoice', ['invoice' => $invoice])
            ->name(Str::lower(Str::slug($name)));
    }
}
