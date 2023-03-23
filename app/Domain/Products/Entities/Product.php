<?php

namespace App\Domain\Products\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @var array
     */
    protected $casts = [
        'id' => 'string'
    ];
}