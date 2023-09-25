<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;
use Illuminate\Http\Response;
use App\Domain\Invoices\Repositories\InvoiceRepository;
use App\Domain\Enums\StatusEnum;
use App\Domain\Enums\ActionInvoiceEnum;

class InvoicesControllerTest extends TestCase
{
    public function testInvoicesAreListed() 
    {
        $this->json('get', 'api/invoices')
            ->assertStatus(Response::HTTP_OK);
    }

    public function testInvoiceIsRetreived() 
    {
        $lastInvoice = $this->invoiceRepository->getLastInvoice();
        $this->json('get', 'api/invoices/' . $lastInvoice->id)
            ->assertStatus(Response::HTTP_OK);
    }

    public function testInvoiceIsApproved() 
    {
        $createInvoice = $this->invoice::factory()->count(1)->create();
        $lastInvoice = $this->invoiceRepository->getLastInvoice();

        $payload = [
            'action' => ActionInvoiceEnum::APPROVE->value
        ];

        $this->json('put', 'api/invoices/' . $lastInvoice->id, $payload)
            ->assertStatus(Response::HTTP_OK);

        $lastInvoice = $this->invoiceRepository->getLastInvoice();

        $this->assertEquals($lastInvoice->status, StatusEnum::APPROVED->value);    
    }

    public function testInvoiceIsRejected() 
    {
        $createInvoice = $this->invoice::factory()->count(1)->create();
        $lastInvoice = $this->invoiceRepository->getLastInvoice();

        $payload = [
            'action' => ActionInvoiceEnum::REJECT->value
        ];

        $this->json('put', 'api/invoices/' . $lastInvoice->id, $payload)
            ->assertStatus(Response::HTTP_OK);
        
        $lastInvoice = $this->invoiceRepository->getLastInvoice();

        $this->assertEquals($lastInvoice->status, StatusEnum::REJECTED->value);      
    }
}
