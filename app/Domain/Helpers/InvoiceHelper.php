<?php

namespace App\Domain\Helpers;

use Illuminate\Database\Eloquent\Collection;
use App\Domain\Enums\ActionInvoiceEnum;
use Illuminate\Http\Response;

class InvoiceHelper
{
    /**
     * @param Collection $invoiceProductsById
     * @return Collection
     */
    public static function addAmountProductsToProductsObject(
        Collection $invoiceProductsById
    ): Collection {
        $invoiceProductsById = $invoiceProductsById[0]
            ->products->map(function($invoiceProduct, $key) use ($invoiceProductsById)
                {	
                    $invoiceProductsById[0]->products[$key]['amountProducts'] = 
                        $invoiceProduct->price * $invoiceProduct->pivot->quantity;								
                    return $invoiceProductsById[0];
                });

        return $invoiceProductsById->slice(0,1);
    }

    /**
     * @param Collection $invoiceProductsById
     * @return Collection
     */
    public static function addTotalAmountProductsToInvoiceObject(
        Collection $invoiceProductsById
    ): Collection {
        $invoiceProductsById = $invoiceProductsById[0]
            ->products->map(function($invoiceProduct, $key) use ($invoiceProductsById)
                {	
                    $invoiceProductsById[0]['totalAmountProducts'] += 
                        $invoiceProductsById[0]->products[$key]->amountProducts;		
                    return $invoiceProductsById[0];
                });

        return $invoiceProductsById->slice(0,1);
    }

    /**
     * @param string $actionName
     * @return string|false
     */
    public static function validateInvoiceActionName(string $actionName): string|false {
        $actions = array_column(ActionInvoiceEnum::cases(), 'value');

        if (in_array($actionName, $actions)) {
            return $actionName;
        }

        return false;
    }
}