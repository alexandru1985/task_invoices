<?php

namespace Tests\Feature\App\Helpers;

use Tests\TestCase;
use Illuminate\Http\Response;
use App\Domain\Invoices\Repositories\InvoiceRepository;
use App\Domain\Helpers\InvoiceHelper;
use App\Domain\Enums\ActionInvoiceEnum;

class InvoiceHelperTest extends TestCase
{
    public function testValidateInvoiceActionName() 
    {
        $invoiceHelper = new InvoiceHelper();

        $this->assertEquals(ActionInvoiceEnum::APPROVE->value,
            $invoiceHelper->validateInvoiceActionName(ActionInvoiceEnum::APPROVE->value));   
    }

    public function testAmountProductsAttributeWasAddedToObject()
    {
        $lastInvoice = $this->invoiceRepository->getLastInvoice();
        $invoiceProducts = $this->invoiceRepository->getInvoiceProductsById($lastInvoice);

        $invoiceHelper = new InvoiceHelper();
        $getProduct = $invoiceHelper->addAmountProductsToProductsObject(
            $invoiceProducts)[0]->products[0];
        $getAttributesOfProductObject = $getProduct->getAttributes();

        $this->assertArrayHasKey('amountProducts', $getAttributesOfProductObject);
    }
}