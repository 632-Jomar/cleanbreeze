<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationProduct extends Model
{
    protected $guarded = [];

    /**Relationship */
    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productVoltage() {
        return $this->belongsTo(ProductVoltage::class, 'product_voltage_id');
    }

    public function productExtension() {
        return $this->belongsTo(ProductExtension::class, 'product_extension_id');
    }

    public function productLedLight() {
        return $this->belongsTo(ProductLedLight::class, 'product_led_light_id');
    }

    /** Accessor */
    public function getLineTotalAttribute() {
        return $this->quantity * $this->product->price;
    }

    public function getTotalProductPriceAttribute() {
        $voltagePrice = $this->productVoltage->price ?? 0;
        $extensionPrice = $this->productExtension->price ?? 0;
        $ledLightPrice = $this->productLedLight->price ?? 0;
    
        return $this->line_total + $voltagePrice + $extensionPrice + $ledLightPrice;
    }

    public function getDropDownAttribute() {
        return [
            'names'    => $this->selected['brand']->productNames,
            'types'    => $this->selected['name']->productTypes,
            'products' => $this->selected['type']->products
        ];
    }

    public function getSelectedAttribute() {
        return [
            'brand'   => $this->product->productType->productName->productBrand,
            'name'    => $this->product->productType->productName,
            'type'    => $this->product->productType,
            'product' => $this->product,
        ];
    }

    /** User-defined */
    public function getProductBrandAttribute() {
        return $this->product->productType->productName->productBrand;
    }
}
