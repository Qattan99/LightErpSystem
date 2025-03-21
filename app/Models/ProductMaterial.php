<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMaterial extends Model
{
    //

    protected $fillable = [
        'product_id',
        'material_id',
        'quantity_in_material',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
