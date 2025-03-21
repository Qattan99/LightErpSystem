<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //
    protected $fillable = [
        'name',
        'unit',
        'unit_price',

    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
