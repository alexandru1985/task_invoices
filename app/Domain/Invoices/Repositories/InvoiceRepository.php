<?php

namespace App\Domain\Invoices\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Domain\Invoices\Interfaces\InvoiceRepositoryInterface;
use App\Domain\Invoices\Entities\Invoice;

class InvoiceRepository implements InvoiceRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAllInvoices(): Collection
    {
        return Invoice::with('company')->get();
    }

    /**
     * @param Invoice $invoice
     * @return Collection
     */
    public function getInvoiceProductsById(Invoice $invoice): Collection
    {
        return Invoice::with('company', 'products')->where('id', '=', $invoice->id)->get();
    }
}