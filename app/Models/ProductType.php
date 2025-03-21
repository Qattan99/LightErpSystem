<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    //
    protected $fillable = [
        'name',
        'details',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
