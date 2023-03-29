<?php

namespace App\Domain\Invoices\Listeners;

use App\Modules\Approval\Api\Events\EntityRejected;
use App\Domain\Invoices\Repositories\InvoiceRepository;
use App\Domain\Enums\StatusEnum;

class RejectInvoice 
{
    /**
     * @param EntityRejected $event
     * @return int
     */
    public function handle(EntityRejected $event): int
    {
        $invoice = $event->approvalDto->entity;
        $repsository = new InvoiceRepository();
        $data = ['status' => StatusEnum::REJECTED->value];

        return $repsository->updateInvoice($invoice, $data);
    }
}