<?php

namespace App\Http\Controllers;

use App\ActivityLog;
use App\Http\Traits\ImageTrait;
use App\Product;
use App\ProductBrand;
use App\ProductExtension;
use App\ProductLedLight;
use App\ProductVoltage;
use App\Quotation;
use App\QuotationMisc;
use App\QuotationProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{
    use ImageTrait;

    public function __construct()
    {
        $this->middleware('userType:1,2');
        $this->middleware('userType:2')->only('create');
        $this->middleware('userType:1')->only('destroy');
    }

    public function index() {
        $quotations = Quotation::paginatedRecords();

        return view('quotations.index', compact('quotations'));
    }

    public function create() {
        return view('quotations.create');
    }

    public function store() {
        DB::beginTransaction();

        try {
            $quotationId = Quotation::generateId();

            $quotation = Quotation::create([
                'id'        => $quotationId,
                'root_id'   => $quotationId,

                'jo_number' => request('jo_number'),
                'name'      => request('name'),
                'contact'   => request('contact'),
                'email'     => request('email'),
                'project'   => request('project'),
                'address'   => request('address'),
                'location'  => request('location'),

                'labor_cost'    => request('labor_cost'),
                'material_cost' => request('material_cost'),
                'mobilization'  => request('mobilization'),
                'other_install' => request('other_install'),
                'delivery_fee'  => request('delivery_fee'),

                'payment_method' => request('payment_method'),
                'discount'       => request('discount'),
                'is_vat'         => request('is_vat') ?? 0,
                'notes'          => request('notes'),

                'created_by' => auth()->id()
            ]);

            if (request()->has('product_id')) {
                foreach (request('product_id') as $key => $productId) {
                    $product          = Product::findOrFail($productId);
                    $productVoltage   = ProductVoltage::find(request('voltage_id')[$key]);
                    $productExtension = ProductExtension::find(request('extension_id')[$key]);
                    $productLedLight  = ProductLedLight::find(request('led_light_id')[$key]);

                    QuotationProduct::create([
                        'quotation_id' => $quotation->id,
                        'product_id'   => $product->id,

                        'product_voltage_id'   => $productVoltage->id ?? null,
                        'product_extension_id' => $productExtension->id ?? null,
                        'product_led_light_id' => $productLedLight->id ?? null,

                        'voltage_price'   => $productVoltage->price ?? null,
                        'extension_price' => $productExtension->price ?? null,
                        'led_light_price' => $productLedLight->price ?? null,

                        'warranty' => request('warranty')[$key],
                        'color'    => request('color')[$key],
                        'quantity' => request('quantity')[$key],
                        'price'    => $product->price
                    ]);
                }
            }

            if (request()->has('misc_description')) {
                foreach (request('misc_description') as $key => $description) {
                    QuotationMisc::create([
                        'quotation_id' => $quotation->id,
                        'description'  => $description,
                        'price'        => request('misc_price')[$key]
                    ]);
                }
            }

            ActivityLog::create([
                'entity_id'   => $quotation->id,
                'entity_type' => 'Quotation',
                'description' => 'New quotation added'
            ]);

            DB::commit();

            return response([
                'message' => 'Quotation has been created successfully'
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function show(Quotation $quotation) {
        $brands  = ProductBrand::all();
        $cluster = Quotation::where('root_id', $quotation->root_id)->orderBy('id', 'DESC')->get();

        return view('quotations.show', compact('quotation', 'brands', 'cluster'));
    }

    public function update(Quotation $quotation) {
        DB::beginTransaction();

        try {
            abort_if($quotation->has_approved, 403, 'Quotation already approved');

            $newQuotation = Quotation::create([
                'id'      => $quotation->revisionId(),
                'root_id' => $quotation->root_id,

                'jo_number' => request('jo_number'),
                'name'      => request('name'),
                'contact'   => request('contact'),
                'email'     => request('email'),
                'project'   => request('project'),
                'address'   => request('address'),
                'location'  => request('location'),

                'labor_cost'    => request('labor_cost'),
                'material_cost' => request('material_cost'),
                'mobilization'  => request('mobilization'),
                'other_install' => request('other_install'),
                'delivery_fee'  => request('delivery_fee'),

                'payment_method' => request('payment_method'),
                'discount'       => request('discount'),
                'is_vat'         => request('is_vat') ?? 0,
                'notes'          => request('notes'),

                'created_by' => $quotation->created_by,
                'revised_by' => auth()->id()
            ]);

            if (request()->has('product_id')) {
                foreach (request('product_id') as $key => $productId) {
                    $product          = Product::findOrFail($productId);
                    $productVoltage   = ProductVoltage::find(request('voltage_id')[$key]);
                    $productExtension = ProductExtension::find(request('extension_id')[$key]);
                    $productLedLight  = ProductLedLight::find(request('led_light_id')[$key]);

                    QuotationProduct::create([
                        'quotation_id' => $quotation->id,
                        'product_id'   => $product->id,

                        'product_voltage_id'   => $productVoltage->id ?? null,
                        'product_extension_id' => $productExtension->id ?? null,
                        'product_led_light_id' => $productLedLight->id ?? null,

                        'voltage_price'   => $productVoltage->price ?? null,
                        'extension_price' => $productExtension->price ?? null,
                        'led_light_price' => $productLedLight->price ?? null,

                        'warranty' => request('warranty')[$key],
                        'color'    => request('color')[$key],
                        'quantity' => request('quantity')[$key],
                        'price'    => $product->price
                    ]);
                }
            }

            if (request()->has('misc_description')) {
                foreach (request('misc_description') as $key => $description) {
                    QuotationMisc::create([
                        'quotation_id' => $newQuotation->id,
                        'description'  => $description,
                        'price'        => request('misc_price')[$key]
                    ]);
                }
            }

            ActivityLog::create([
                'entity_id'   => $newQuotation->id,
                'entity_type' => 'Quotation',
                'description' => 'Quotation details updated'
            ]);

            DB::commit();

            return response([
                'message' => 'Quotation has been updated successfully'
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function destroy(Quotation $quotation) {
        DB::beginTransaction();

        try {
            abort_if($quotation->is_approved, 403, "Approved quotation can't be deleted");
            $quotation->update(['deleted_at' => now()]);

            ActivityLog::create([
                'entity_id'   => $quotation->id,
                'entity_type' => 'Quotation',
                'description' => 'Quotation deleted'
            ]);

            DB::commit();

            return response([
                'message' => 'Quotation has been removed'
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function approve(Quotation $quotation) {
        try {
            abort_if($quotation->has_approved, 403, 'Quotation has already approved status.');
            $quotation->update(['approved_at' => now()]);

            ActivityLog::create([
                'entity_id'   => $quotation->id,
                'entity_type' => 'Quotation',
                'description' => 'Quotation approved'
            ]);

            return response([
                'message' => 'Quote approved!'
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function print(Quotation $quotation) {
        abort_unless($quotation->is_approved, 403, 'Quotation must be approved first.');
        return view('quotations.print.index', compact('quotation'));
    }

    /** Upload Image */
    public function uploadQuotationImage() {
        try {
            if (request('quotation_id')) {
                $quotation = Quotation::find(request('quotation_id'));

                abort_if($quotation->has_approved, 403, 'Unable to upload image');

                $filename = $this->filenameByQuotation(request('file'), $quotation);
                $this->storeImage('img-quotations', $filename, request('file'));

                return response([
                    'url' => "/storage/img-quotations/$filename"
                ]);
            }

            abort(404, 'Quotation ID not found.');

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
