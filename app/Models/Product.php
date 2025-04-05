<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    //
    protected $fillable = [
        'name',
        'details',
        'type_id',
        'color',
        'cost',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function productImage(): HasMany
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function oneImage(): HasOne
    {
        return $this->hasOne(ProductImage::class,'product_id')->latest('id');
    }
}
