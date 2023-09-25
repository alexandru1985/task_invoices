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

    /**
     * @param Invoice $invoice
     * @param array $data
     * @return int
     */
    public function updateInvoice(Invoice $invoice, array $data): int 
    {
        return Invoice::whereId($invoice->id)->update($data);
    }

    /**
     * @param Invoice $invoice
     * @param array $data
     */
    public function getInvoiceById(Invoice $invoice): Invoice 
    {
        return Invoice::findOrFail($invoice->id);
    }

    /**
     * @return Invoice 
     */
    public function getLastInvoice(): Invoice 
    {
        return Invoice::with('company')->latest('created_at')->first();
    }
}