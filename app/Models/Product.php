<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name',
        'details',
        'type_id',
        'color',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
