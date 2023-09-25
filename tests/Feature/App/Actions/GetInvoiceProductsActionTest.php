<?php

namespace Tests\Feature\App\Actions;

use Tests\TestCase;
use Spatie\LaravelData\DataCollection;
use App\Domain\Invoices\Actions\GetInvoiceProductsAction;
use App\Domain\Invoices\Repositories\InvoiceRepository;

class GetInvoiceProductsActionTest extends TestCase
{
    public function testHandleReturnsCorrectObject()
    {
        $lastInvoice = $this->invoiceRepository->getLastInvoice();
        $invoiceProducts = $this->invoiceRepository->getInvoiceProductsById($lastInvoice);
        $getInvoiceProductsAction = new GetInvoiceProductsAction();
    
        $this->assertInstanceOf(DataCollection::class, $getInvoiceProductsAction->handle($invoiceProducts));
    }
}