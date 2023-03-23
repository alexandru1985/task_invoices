<?php

namespace App\Domain\Invoices\Actions;

use App\Domain\Invoices\DTOs\InvoicesDTO;
use App\Domain\Invoices\Entities\Invoice;
use Spatie\LaravelData\DataCollection;

class GetInvoiceProducts
{
    /**
     * @param Invoice $invoice
     * @return DataCollection
     */
    public function handle(Invoice $invoice): DataCollection
    {
        // dd(Invoice::Invoice::invoiceProducts($invoice));

        return InvoicesDTO::collection(Invoice::invoiceProducts($invoice));
    }
}