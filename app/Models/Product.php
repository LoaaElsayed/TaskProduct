<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    public function productAttribute()
    {
        return $this->hasMany(ProductAttribute::class,'product_id');
    }

}
