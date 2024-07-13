<?php

namespace App\Http\Controllers;

use App\ActivityLog;
use App\Product;
use App\ProductBrand;
use App\ProductExtension;
use App\ProductLedLight;
use App\ProductName;
use App\ProductType;
use App\ProductVoltage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('userType:1');
    }

    public function index() {
        $products = Product::where('deleted_at', null)->orderBy('id')->get();

        return view('products.index', compact('products'));
    }

    public function create() {
        $productBrands = ProductBrand::orderBy('brand')->get();
        $productNames  = ProductName::orderBy('category_name')->get();

        return view('products.create', compact('productBrands', 'productNames'));
    }

    public function store() {
        DB::beginTransaction();

        $this->validate(request(), [
            'product_name'     => 'required|unique:product_names,category_name',
            'product_brand_id' => 'required|exists:product_brands,id'
        ]);

        try {
            $productName = ProductName::firstOrCreate(
                ['category_name'    => request('product_name')],
                ['product_brand_id' => request('product_brand_id')]
            );

            $productType = ProductType::firstOrCreate(
                ['type'            => request('product_type')],
                ['product_name_id' => $productName->id]
            );

            $product = Product::updateOrCreate(
                ['product_type_id' => $productType->id, 'diameter' => request('diameter')],
                ['price'           => request('price')]
            );

            ActivityLog::create([
                'entity_id'   => $product->id,
                'entity_type' => 'Product',
                'description' => 'New product added',
            ]);

            DB::commit();

            return response([
                'message'       => 'Product has been created successfully.',
                'product_names' => ProductName::orderBy('category_name')->get()
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function storeCategory() {
        DB::beginTransaction();

        $this->validate(request(), [
            'product_type_id' => 'required|exists:product_types,id',

            'voltage'   => 'sometimes|required',
            'extension' => 'sometimes|required',
            'led'       => 'sometimes|required'
        ]);

        try {
            if (request()->has('voltage')) {
                $productVoltage = ProductVoltage::firstOrCreate(
                    [
                        'voltage'         => request('voltage'),
                        'product_type_id' => request('product_type_id')
                    ],
                    ['price' => request('voltage_price') ?? 0]
                );

                if ($productVoltage->wasRecentlyCreated) {
                    ActivityLog::create([
                        'entity_id'   => $productVoltage->id,
                        'entity_type' => 'Product Voltage',
                        'description' => 'New product voltage added'
                    ]);
                }
            }

            if (request()->has('extension')) {
                $productExtension = ProductExtension::firstOrCreate(
                    [
                        'extension'       => request('extension'),
                        'product_type_id' => request('product_type_id')
                    ],
                    ['price' => request('extension_price') ?? 0],
                );

                if ($productExtension->wasRecentlyCreated) {
                    ActivityLog::create([
                        'entity_id'   => $productExtension->id,
                        'entity_type' => 'Product Extension',
                        'description' => 'New product extension added'
                    ]);
                }
            }

            if (request()->has('led')) {
                $productLedLight = ProductLedLight::firstOrCreate(
                    [
                        'led'             => request('led'),
                        'product_type_id' => request('product_type_id')
                    ],
                    ['price' => request('led_price') ?? 0],
                );

                if ($productLedLight->wasRecentlyCreated) {
                    ActivityLog::create([
                        'entity_id'   => $productLedLight->id,
                        'entity_type' => 'Product LED Light',
                        'description' => 'New product LED light added'
                    ]);
                }
            }

            DB::commit();

            return response(['message' => 'Produc Category has been created successfully.']);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function show(Product $product) {
        if (request()->ajax()) {
            return $product->load(['productType.productName.productBrand']);
        }
    }

    public function update(Product $product) {
        DB::beginTransaction();

        try {
            $product->update([
                'diameter' => request('diameter'),
                'price'    => request('price')
            ]);

            ActivityLog::create([
                'entity_id'   => $product->id,
                'entity_type' => 'Product',
                'description' => 'Product details updated'
            ]);

            DB::commit();

            return response([
                'message' => 'Product has been updated successfully.',
                'data'    => $product
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function destroy(Product $product) {
        DB::beginTransaction();

        try {
            abort_if($product->quotationProducts->count(), 406, 'This is used by quotations.'); 
            $product->update(['deleted_at' => now()]);

            ActivityLog::create([
                'entity_id'   => $product->id,
                'entity_type' => 'Product',
                'description' => 'Product deleted'
            ]);

            DB::commit();

            return response(['message' => 'Product has been deleted successfully.']);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
