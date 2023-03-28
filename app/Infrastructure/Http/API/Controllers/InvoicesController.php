<?php

namespace App\Infrastructure\Http\API\Controllers;

use App\Infrastructure\Controller;
use App\Domain\Invoices\Actions\GetInvoicesAction;
use App\Domain\Invoices\Actions\GetInvoiceProductsAction;
use App\Domain\Invoices\Interfaces\InvoiceRepositoryInterface;
use App\Domain\Invoices\Actions\UpdateInvoiceAction;
use App\Domain\Invoices\DTOs\InvoicesDTO;
use App\Domain\Invoices\Entities\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class InvoicesController extends Controller 
{
    /**
     * @param InvoiceRepositoryInterface $invoiceRepository
     */
    public function __construct(
        public InvoiceRepositoryInterface $invoiceRepository
    ) {
    }

    /**
     * @param GetInvoicesAction $getInvoicesAction
     * @param InvoiceRepositoryInterface $invoiceRepository
     * @return JsonResponse
     */
    public function index(
        GetInvoicesAction $getInvoicesAction,
        InvoiceRepositoryInterface $invoiceRepository
    ): JsonResponse {
        $invoices = $invoiceRepository->getAllInvoices();

        return response()->json($getInvoicesAction->handle($invoices), Response::HTTP_OK);
    }

    /**
     * @param Invoice $invoice
     * @param GetInvoiceProductsAction $getInvoiceProductsAction
     * @param InvoiceRepositoryInterface $invoiceRepository
     * @return JsonResponse
     */
    public function show(
        Invoice $invoice, 
        GetInvoiceProductsAction $getInvoiceProductsAction,
        InvoiceRepositoryInterface $invoiceRepository
    ): JsonResponse {
        $invoiceProductsById = $invoiceRepository->getInvoiceProductsById($invoice);

        return response()->json($getInvoiceProductsAction->handle($invoiceProductsById), Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @param Invoice $invoice
     * @param UpdateInvoiceAction $updateInvoiceAction
     * @return JsonResponse
     */
    public function update(
        Request $request,
        Invoice $invoice,
        UpdateInvoiceAction $updateInvoiceAction
    ): JsonResponse {
        return response()->json($updateInvoiceAction->handle($request, $invoice), Response::HTTP_OK);
    }
}