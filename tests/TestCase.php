<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use App\Domain\Invoices\Repositories\InvoiceRepository;
use App\Domain\Invoices\Entities\Invoice;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    protected $invoiceRepository = null;
    protected $invoice = null;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed');
        $this->invoiceRepository = new InvoiceRepository();
        $this->invoice = new Invoice();
    }
}