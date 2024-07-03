<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $guarded = [];

    public function productName() {
        return $this->belongsTo(ProductName::class, 'product_name_id');
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function productVoltages() {
        return $this->hasMany(ProductVoltage::class);
    }

    public function productExtensions() {
        return $this->hasMany(ProductExtension::class);
    }

    public function productLedLights() {
        return $this->hasMany(ProductLedLight::class);
    }
}
