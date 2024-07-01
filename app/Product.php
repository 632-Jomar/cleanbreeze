<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function productDiameter() {
        return $this->belongsTo(ProductDiameter::class, 'product_diameter_id');
    }
}
