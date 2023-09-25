<?php

namespace App\Domain\Invoices\Actions;

use App\Domain\Invoices\DTOs\InvoicesDTO;
use App\Domain\Invoices\Entities\Invoice;
use Spatie\LaravelData\DataCollection;
use Illuminate\Database\Eloquent\Collection;
use App\Domain\Helpers\InvoiceHelper;

class GetInvoiceProductsAction
{
    /**
     * @param Collection $invoiceProductsById
     * @return DataCollection
     */
    public function handle(Collection $invoiceProductsById): DataCollection
    { 
        $invoiceHelper = new InvoiceHelper();
        $invoiceProductsById = 
            $invoiceHelper->addAmountProductsToProductsObject($invoiceProductsById);
        $invoiceProductsById = 
            $invoiceHelper->addTotalAmountProductsToInvoiceObject($invoiceProductsById);

        return InvoicesDTO::collection($invoiceProductsById);
    }
}