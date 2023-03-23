<?php

namespace App\Domain\Invoices\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Companies\Entities\Company;
use App\Domain\Products\Entities\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Collection;

class Invoice extends Model
{ 
    /**
     * @var array
     */
    protected $casts = [
        'id' => 'string'
    ];

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->BelongsTo(Company::class);
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'invoice_product_lines');
    }

    /**
     * @return Collection
     */
    public static function getInvoices(): Collection
    {
        return self::with('company')->get();
    }

    /**
     * @param Invoice $invoice
     * @return Collection
     */
    public static function invoiceProducts(Invoice $invoice): Collection
    {
        return self::with('company', 'products')->where('id', '=', $invoice->id)->get();
    }
}