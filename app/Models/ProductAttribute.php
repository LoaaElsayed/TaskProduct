<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productAttributevalue()
    {
        return $this->hasMany(ProductAttributeValue::class,'product_attribute_id');
    }

}
