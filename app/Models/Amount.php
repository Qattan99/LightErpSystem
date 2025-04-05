<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amount extends Model
{
    //
    protected $fillable = [
        'product_id',
        'branch_id',
        'quantity',
        'final_price',
        'is_active',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
