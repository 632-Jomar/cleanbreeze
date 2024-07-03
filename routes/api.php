<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function() {
    Route::get('products', 'ProductApiController@products');
    Route::get('products/{product}', 'ProductApiController@findProducts');

    Route::get('product-brands', 'ProductApiController@productBrands');
    Route::get('product-names/{product_brand}/brand', 'ProductApiController@name');
    Route::get('product-types/{product_name}/name', 'ProductApiController@type');
    
    Route::get('product-brands/{product_brand}', 'ProductApiController@productBrand');
    Route::get('product-names/{product_name}', 'ProductApiController@productName');
    Route::get('product-types/{product_type}', 'ProductApiController@productType');

    Route::get('product-voltages/{product_voltage}', 'ProductApiController@productVoltage');
    Route::get('product-extensions/{product_extension}', 'ProductApiController@productExtension');
    Route::get('product-leds/{product_led_light}', 'ProductApiController@productLed');
});
