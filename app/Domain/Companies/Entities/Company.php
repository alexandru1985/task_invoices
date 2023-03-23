<?php

namespace App\Domain\Companies\Entities;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * @var array 
     */
    protected $casts = [
        'id' => 'string'
    ];
}