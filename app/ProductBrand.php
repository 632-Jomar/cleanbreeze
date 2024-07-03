<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    protected $guarded = [];

    public function productNames() {
        return $this->hasMany(ProductName::class)->orderBy('category_name');
    }

    public function getDynamicAttribute() {
        return $this->load('productNames.productTypes.products');
    }
}
