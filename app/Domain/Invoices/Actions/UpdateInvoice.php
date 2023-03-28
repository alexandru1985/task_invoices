<?php

namespace App\Domain\Invoices\Actions;

use App\Domain\Invoices\DTOs\InvoicesDTO;
use App\Domain\Invoices\Entities\Invoice;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Modules\Approval\Api\Dto\ApprovalDto;
use App\Modules\Approval\Application\ApprovalFacade;
use App\Modules\Approval\Application\Info;
use App\Modules\Approval\Application\TestFacade;
use Ramsey\Uuid\Uuid;
use App\Domain\Enums\StatusEnum;
use App\Modules\Approval\Api\ApprovalFacadeInterface;

class UpdateInvoice
{
    public function __construct(
        private readonly ApprovalFacadeInterface $facade
    ) {
    }
    /**
     * @param Request $request
     * @param Invoice $invoice
     * @return DataCollection
     */
    public function handle(Request $request, Invoice $invoice): DataCollection
    {
        $facade = new ApprovalFacade;
        $this->facade->approve(new ApprovalDto(
            Uuid::fromString($invoice->id),
            StatusEnum::tryFrom($request->status),
            class_basename($invoice)
        ));
        return InvoicesDTO::collection(Invoice::invoiceProducts($invoice));
    }
}