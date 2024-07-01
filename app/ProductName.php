<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductName extends Model
{
    protected $guarded = [];

    public function productBrand() {
        return $this->belongsTo(ProductBrand::class, 'product_brand_id');
    }

    public function productTypes() {
        return $this->hasMany(ProductType::class)->orderBy('type');
    }
}
