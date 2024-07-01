<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotationProduct extends Model
{
    protected $guarded = [];

    /**Relationship */
    public function productDiameter() {
        return $this->belongsTo(ProductDiameter::class, 'product_diameter_id');
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
        return $this->quantity * $this->productDiameter->product->price;
    }

    public function getTotalProductPriceAttribute() {
        $voltagePrice = $this->productVoltage->price ?? 0;
        $extensionPrice = $this->productExtension->price ?? 0;
        $ledLightPrice = $this->productLedLight->price ?? 0;
    
        return $this->line_total + $voltagePrice + $extensionPrice + $ledLightPrice;
    }

    public function getDropDownAttribute() {
        return [
            'names'     => $this->selected['brand']->productNames,
            'types'     => $this->selected['name']->productTypes,
            'diameters' => $this->selected['type']->productDiameters
        ];
    }

    public function getSelectedAttribute() {
        return [
            'brand'    => $this->productDiameter->productType->productName->productBrand,
            'name'     => $this->productDiameter->productType->productName,
            'type'     => $this->productDiameter->productType,
            'diameter' => $this->productDiameter,
        ];
    }
}
