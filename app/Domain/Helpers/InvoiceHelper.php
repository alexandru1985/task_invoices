<?php

namespace App\Domain\Helpers;

use Illuminate\Database\Eloquent\Collection;

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
}