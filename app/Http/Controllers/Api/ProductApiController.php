<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductBrand;
use App\ProductDiameter;
use App\ProductExtension;
use App\ProductLedLight;
use App\ProductName;
use App\ProductType;
use App\ProductVoltage;

class ProductApiController extends Controller
{
    public function products() {
        return Product::orderBy('id')->get();
    }

    public function productBrands() {
        return ProductBrand::orderBy('brand')->get();
    }

    public function findProducts(Product $product) {
        return $product;
    }

    public function productBrand(ProductBrand $productBrand) {
        return $productBrand->load('productNames.productTypes');
    }

    public function productName(ProductName $productName) {
        return $productName->load('productTypes');
    }

    public function productType(ProductType $productType) {
        return $productType->load(['products', 'productVoltages', 'productExtensions', 'productLedLights']);
    }

    public function productVoltage(ProductVoltage $productVoltage) {
        return $productVoltage;
    }
    
    public function productExtension(ProductExtension $productExtension) {
        return $productExtension;
    }

    public function productLed(ProductLedLight $productLedLight) {
        return $productLedLight;
    }

    /** Single Query */
    public function name(ProductBrand $productBrand) {
        return $productBrand->productNames;
    }

    public function type(ProductName $productName) {
        return $productName->productTypes;
    }
}
