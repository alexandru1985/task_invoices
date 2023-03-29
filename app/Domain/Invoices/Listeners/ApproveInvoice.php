<?php

namespace App\Domain\Invoices\Listeners;

use App\Modules\Approval\Api\Events\EntityApproved;
use App\Domain\Invoices\Repositories\InvoiceRepository;
use App\Domain\Enums\StatusEnum;

class ApproveInvoice 
{
    /**
     * @param EntityApproved $event
     * @return int
     */
    public function handle(EntityApproved $event): int
    {
        $invoice = $event->approvalDto->entity;
        $repsository = new InvoiceRepository();
        $data = ['status' => StatusEnum::APPROVED->value];

        return $repsository->updateInvoice($invoice, $data);
    }
}