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
    
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';
}