<?php

namespace App\Domain\Invoices\Actions;

use App\Domain\Invoices\Entities\Invoice;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Modules\Approval\Api\Dto\ApprovalDto;
use App\Modules\Approval\Application\ApprovalFacade;
use Ramsey\Uuid\Uuid;
use App\Domain\Enums\StatusEnum;
use App\Domain\Enums\ActionInvoiceEnum;
use App\Modules\Approval\Api\ApprovalFacadeInterface;
use App\Domain\Helpers\InvoiceHelper;
use Illuminate\Http\JsonResponse;

class UpdateInvoiceAction
{
    public function __construct(
        private readonly ApprovalFacadeInterface $facade
    ) {
    }

    /**
     * @param Request $request
     * @param Invoice $invoice
     * @param ApprovalFacade $facade
     * @return JsonResponse
     */
    public function handle(Request $request, Invoice $invoice, ApprovalFacade $facade): JsonResponse
    {
        $action = InvoiceHelper::validateInvoiceActionName($request->action);

        if ($action == false) {
            return response()->json(__('apiMessages.actionParameter'), Response::HTTP_OK);
        }

        if ($action == 'approve' && $invoice->status == StatusEnum::DRAFT->value) {
            $facade->approve(new ApprovalDto(
                Uuid::fromString($invoice->id),
                StatusEnum::tryFrom($invoice->status),
                $invoice
            ));

            return response()->json(__('apiMessages.statusApproved'), Response::HTTP_OK);
        }    

        if ($action == 'reject' && $invoice->status == StatusEnum::DRAFT->value) {
            $facade->reject(new ApprovalDto(
                Uuid::fromString($invoice->id),
                StatusEnum::tryFrom($invoice->status),
                $invoice
            ));

            return response()->json(__('apiMessages.statusRejected'), Response::HTTP_OK);
        }

        return response()->json(__('apiMessages.statusAlreadyUpdated'), Response::HTTP_OK);;
    }
}