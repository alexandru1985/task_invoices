<?php

namespace App\Domain\Invoices\Actions;

use App\Domain\Invoices\DTOs\InvoicesDTO;
use Spatie\LaravelData\DataCollection;
use Illuminate\Database\Eloquent\Collection;

class GetInvoicesAction
{
    /**
     * @param Collection $invoices
     * @return DataCollection
     */
    public function handle(Collection $invoices): DataCollection
    {
        return InvoicesDTO::collection($invoices);
    } 
} 