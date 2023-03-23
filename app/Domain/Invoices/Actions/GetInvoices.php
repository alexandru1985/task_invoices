<?php

namespace App\Domain\Invoices\Actions;

use App\Domain\Invoices\DTOs\InvoicesDTO;
use App\Domain\Invoices\Entities\Invoice;
use Spatie\LaravelData\DataCollection;

class GetInvoices
{
    /**
     * @return DataCollection
     */
    public function handle(): DataCollection
    {
        return InvoicesDTO::collection(Invoice::getInvoices());
    } 
} 