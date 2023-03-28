<?php

namespace App\Domain\Invoices\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use App\Domain\Invoices\Entities\Invoice;


interface InvoiceRepositoryInterface 
{
    /**
     * @return Collection
     */
    public function getAllInvoices(): Collection;

    /**
     * @param Invoice $invoice
     * @return Collection
     */
    public function getInvoiceProductsById(Invoice $invoice): Collection;
}