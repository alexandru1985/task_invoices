<?php

namespace App\Infrastructure\Http\API\Controllers;

use App\Infrastructure\Controller;
use App\Domain\Invoices\Actions\GetInvoices;
use App\Domain\Invoices\Actions\GetInvoiceProducts;
use App\Domain\Invoices\Actions\UpdateInvoice;
use App\Domain\Invoices\DTOs\InvoicesDTO;
use App\Domain\Invoices\Entities\Invoice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class InvoicesController extends Controller 
{
    /**
     * @param GetInvoices $getInvoices
     * @return JsonResponse
     */
    public function index(GetInvoices $getInvoices): JsonResponse 
    {
        return response()->json($getInvoices->handle(), Response::HTTP_OK);
    }

    /**
     * @param Invoice $invoice
     * @param GetInvoiceProducts $getInvoiceProducts
     * @return JsonResponse
     */
    public function show(Invoice $invoice, GetInvoiceProducts $getInvoiceProducts): JsonResponse 
    {
        return response()->json($getInvoiceProducts->handle($invoice), Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @param Invoice $invoice
     * @param UpdateInvoice $updateInvoice
     * @return JsonResponse
     */
    public function update(Request $request, Invoice $invoice, UpdateInvoice $updateInvoice): JsonResponse
    {
        return response()->json($updateInvoice->handle($request, $invoice), Response::HTTP_OK);
    }
}