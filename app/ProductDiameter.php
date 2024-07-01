<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDiameter extends Model
{
    protected $guarded = [];

    public function productType() {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function product() {
        return $this->hasOne(Product::class);
    }
}
