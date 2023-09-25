<?php

namespace App\Domain\Invoices\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Companies\Entities\Company;
use App\Domain\Products\Entities\Product;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\InvoiceFactory;

class Invoice extends Model
{ 
    use HasFactory;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'string'
    ];

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return InvoiceFactory::new();
    }

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
        return $this->belongsToMany(Product::class, 'invoice_product_lines')->withPivot('quantity');
    }
}