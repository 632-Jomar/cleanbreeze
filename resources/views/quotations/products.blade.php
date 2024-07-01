@foreach ($quotation->quotationProducts as $index => $quotationProduct)
    <div class="item-div mb-3">
        <div class="row mb-1">
            <div class="col-6">Item #<span class="item-number">{{ ($index+1) }}</span></div>
            <div class="col-6 text-right">
                <button type="button" class="btn btn-danger btn-sm btn-remove-item" tabindex="-1">
                    <i class="fa fa-trash"></i> Remove Item
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <tr class="bg-info">
                    <td width="15%" class="align-middle text-center">Brand</td>
                    <td width="16%" class="align-middle text-center">Product</td>
                    <td width="16%" class="align-middle text-center">Type</td>
                    <td width="16%" class="align-middle text-center">Description</td>
                    <td width="20%" class="align-middle text-center">Color</td>
                    <td width="7%" class="align-middle text-center">Qty</td>
                    <td width="10%" class="align-middle text-center">Price (PHP)</td>
                </tr>

                <tr>
                    <td>
                        <select style="min-width: 100px" class="form-control form-control-sm mb-2 select-brand" required>
                            <option value="" disabled selected>Select brand</option>

                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $brand->id == $quotationProduct->selected['brand']->id ? 'selected' : '' }}>{{ $brand->brand }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <select style="min-width: 100px" class="form-control form-control-sm select-product" required>
                            <option value="" disabled selected>Select category</option>

                            @foreach ($quotationProduct->drop_down['names'] as $productName)
                                <option value="{{ $productName->id }}" {{ $productName->id == $quotationProduct->selected['name']->id ? 'selected' : '' }}>{{ $productName->category_name }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <select style="min-width: 100px" class="form-control form-control-sm select-type" required>
                            <option value="" disabled selected>Select type</option>

                            @foreach ($quotationProduct->drop_down['types'] as $productType)
                                <option value="{{ $productType->id }}" {{ $productType->id == $quotationProduct->selected['type']->id ? 'selected' : '' }}>{{ $productType->type }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td>
                        <select name="diameter[]" style="min-width: 100px" class="form-control form-control-sm select-description" required>
                            <option value="" disabled selected>Select diameter</option>
                            
                            @foreach ($quotationProduct->drop_down['diameters'] as $productDiameter)
                                <option value="{{ $productDiameter->id }}" {{ $productDiameter->id == $quotationProduct->selected['diameter']->id ? 'selected' : '' }}>{{ $productDiameter->diameter }}</option>
                            @endforeach
                        </select>
                    </td>

                    <td><input name="color[]" style="min-width: 100px" type="text" class="form-control form-control-sm text-right input-color" value="{{ $quotationProduct->color }}"></td>
                    <td><input name="quantity[]" style="min-width: 60px" type="number" step="1" min="0" class="form-control form-control-sm text-right input-quantity" value="{{ $quotationProduct->quantity }}"></td>
                    <td>
                        <input style="min-width: 100px" type="number" class="form-control form-control-sm text-right input-subtotal" value="{{ $quotationProduct->line_total }}" readonly>
                        <input type="hidden" class="input-price" value="{{ $quotationProduct->line_total ?? 0 }}" readonly>
                    </td>
                </tr>

                <tr>
                    <td colspan="7">
                        <table class="table table-bordered table-sm">
                            <tr class="bg-info">
                                <td class="align-middle text-center">Motor & Power</td>
                                <td class="align-middle text-center">Mount</td>
                                <td class="align-middle text-center">LED</td>
                                <td class="align-middle text-center">Warranty</td>
                                <td class="align-middle text-center">Total Product Price</td>
                            </tr>

                            <tr>
                                <td>
                                    <select name="voltage_id[]" class="form-control form-control-sm select-power">
                                        <option value="">Select voltage</option>

                                        @foreach ($quotationProduct->selected['type']->productVoltages as $voltage)
                                            <option value="{{ $voltage->id }}" {{ $voltage->id == $quotationProduct->product_voltage_id ? 'selected' : '' }}>{{ $voltage->voltage }}</option>
                                        @endforeach
                                    </select>

                                    <input type="hidden" class="power-price" value="{{ $quotationProduct->productVoltage->price ?? 0 }}">
                                </td>

                                <td>
                                    <select name="extension_id[]" class="form-control form-control-sm select-mount">
                                        <option value="">Select extension</option>

                                        @foreach ($quotationProduct->selected['type']->productExtensions as $extension)
                                            <option value="{{ $extension->id }}" {{ $extension->id == $quotationProduct->product_extension_id ? 'selected' : '' }}>{{ $extension->extension }}</option>
                                        @endforeach
                                    </select>

                                    <input type="hidden" class="mount-price" value="{{ $quotationProduct->productExtension->price ?? 0 }}">
                                </td>

                                <td>
                                    <select name="led_light_id[]" class="form-control form-control-sm select-led">
                                        <option value="">Select led</option>

                                        @foreach ($quotationProduct->selected['type']->productLedLights as $led)
                                            <option value="{{ $led->id }}" {{ $led->id == $quotationProduct->product_led_light_id ? 'selected' : '' }}>{{ $led->led }}</option>
                                        @endforeach
                                    </select>

                                    <input type="hidden" class="led-price" value="{{ $quotationProduct->productLedLight->price ?? 0 }}">
                                </td>

                                <td><input name="warranty[]" type="text" class="form-control form-control-sm text-right" value="{{ $quotationProduct->warranty }}" required></td>
                                <td><input type="number" class="form-control form-control-sm text-right input-total-price" value="{{ $quotationProduct->total_product_price ?? 0 }}" readonly></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endforeach