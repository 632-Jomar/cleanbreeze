<div class="col">
    <div class="card border border-info">
        <div class="card-header bg-info">
            <h4 class="card-title text-light">Client Details</h4>
        </div>

        <div class="card-body">
            <div class="row align-items-center mb-2">
                <div class="col-3 col-lg-2">
                    <label class="font-weight-normal" class="mb-0" for="jo_number">JO Number:</label>
                </div>

                <div class="col-9 col-lg-4">
                    <input type="text" class="form-control" id="jo_number" name="jo_number" value="{{ $quotation->jo_number ?? '' }}" placeholder="-">
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-3 col-lg-2 col-xl-2 mb-2">
                    <label class="font-weight-normal" class="mb-0" for="email">Email:</label>
                </div>

                <div class="col-9 col-lg-10 col-xl-4 mb-2">
                    <input type="email" class="form-control" id="email" name="email" value="{{ $quotation->email ?? '' }}" placeholder="-">
                </div>

                <div class="col-3 col-lg-2 col-xl-2 mb-2">
                    <label class="font-weight-normal" class="mb-0" for="contact">Contact:</label>
                </div>

                <div class="col-9 col-lg-4 col-xl-4 mb-2">
                    <input type="text" class="form-control" id="contact" name="contact" value="{{ $quotation->contact ?? '' }}" placeholder="-">
                </div>

                <div class="col-3 col-lg-2">
                    <label class="font-weight-normal" class="mb-0" for="name">Name: <span class="text-danger">*</span></label>
                </div>

                <div class="col-9 col-lg-10 mb-2">
                    <input type="text" class="form-control" id="name" name="name" value="{{ $quotation->name ?? '' }}" required>
                </div>
            </div>

            <div class="row align-items-center mb-2">
                <div class="col-3 col-lg-2">
                    <label class="font-weight-normal" class="mb-0" for="project">Project:</label>
                </div>

                <div class="col-9 col-lg-10">
                    <input type="text" class="form-control" id="project" name="project" value="{{ $quotation->project ?? '' }}" placeholder="-">
                </div>
            </div>

            <div class="row align-items-center mb-2">
                <div class="col-3 col-lg-2">
                    <label class="font-weight-normal" class="mb-0" for="address">Address: <span class="text-danger">*</span></label>
                </div>

                <div class="col-9 col-lg-10">
                    <input type="text" class="form-control" id="address" name="address" value="{{ $quotation->address ?? '' }}" required>
                </div>
            </div>

            <div class="row align-items-center mb-2">
                <div class="col-3 col-lg-2">
                    <label class="font-weight-normal" class="mb-0" for="location">Location:</label>
                </div>

                <div class="col-9 col-lg-10">
                    <input type="text" class="form-control" id="location" name="location" value="{{ $quotation->location ?? '' }}" placeholder="-">
                </div>
            </div>
        </div>
    </div>

    <div class="card border border-info">
        <div class="card-header bg-info">
            <h4 class="card-title text-light d-flex align-items-center">
                Product Items
            </h4>

            <div class="card-tools">
                <button type="button" id="btn-add-item" href="#" class="btn btn-success btn-sm" tabindex="-1"><i class="fa fa-plus"></i></button>
            </div>
        </div>

        <div class="card-body">
            <div id="product-items">
                @isset($quotation)
                    @include('quotations.products')
                @endisset
            </div>
        </div>
    </div>

    <div class="card border border-info">
        <div class="card-header bg-info">
            <h4 class="card-title text-light">Summary</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row align-items-center mb-2">
                        <div class="col-5">
                            <label class="font-weight-normal" for="labor_cost">Labor Cost:</label>
                        </div>

                        <div class="col-7">
                            <input type="number" class="form-control text-right summary-input-group" name="labor_cost" id="labor_cost" value="{{ $quotation->labor_cost ?? '' }}" placeholder="0">
                        </div>
                    </div>

                    <div class="row align-items-center mb-2">
                        <div class="col-5">
                            <label class="font-weight-normal" for="material_cost">Material Cost:</label>
                        </div>

                        <div class="col-7">
                            <input type="number" class="form-control text-right summary-input-group" name="material_cost" id="material_cost" value="{{ $quotation->material_cost ?? '' }}" placeholder="0">
                        </div>
                    </div>

                    <div class="row align-items-center mb-2">
                        <div class="col-5">
                            <label class="font-weight-normal" for="material_cost">Mobilization:</label>
                        </div>

                        <div class="col-7">
                            <input type="number" class="form-control text-right summary-input-group" name="mobilization" id="mobilization" value="{{ $quotation->mobilization ?? '' }}" placeholder="0">
                        </div>
                    </div>

                    <div class="row align-items-center mb-2">
                        <div class="col-5">
                            <label class="font-weight-normal" for="material_cost" style="line-height: 100%">Others <br> <small>(Installation fee)</small>:</label>
                        </div>

                        <div class="col-7">
                            <input type="number" class="form-control text-right summary-input-group" name="other_install" id="other_install" value="{{ $quotation->other_install ?? '' }}" placeholder="0">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="row align-items-center mb-2">
                        <div class="col-5">
                            <label class="font-weight-normal" for="delivery_fee">Delivery fee:</label>
                        </div>

                        <div class="col-7">
                            <input type="number" class="form-control text-right summary-input-group"  name="delivery_fee" id="delivery_fee" value="{{ $quotation->delivery_fee ?? '' }}" placeholder="0">
                        </div>
                    </div>

                    <div class="row align-items-center mb-2">
                        <div class="col-5">
                            <label class="font-weight-normal" for="total_product_cost">Total Product Cost:</label>
                        </div>

                        <div class="col-7">
                            <input type="number" class="form-control text-right summary-input-group" id="total_product_cost" placeholder="0" value="{{ $quotation->total_product_cost ?? '' }}" disabled>
                        </div>
                    </div>

                    <div class="row align-items-center mb-2">
                        <div class="col-5">
                            <label class="font-weight-normal" for="total_other_charges">Total Other Charges:</label>
                        </div>

                        <div class="col-7">
                            <input type="number" class="form-control text-right" id="total_other_charges" value="{{ $quotation->total_other_charges ?? 0 }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-transparent">
            <div class="row">
                <div class="col-lg-3 mb-2">
                    Others: <button type="button" id="btn-add-other" class="btn btn-primary btn-sm" tabindex="-1"><i class="fa fa-plus"></i></button>
                </div>

                <div class="col-md-9 mb-2" id="other-div">
                    @isset($quotation)
                        @foreach ($quotation->quotationMiscs as $misc)
                            <div class="row align-items-center mb-2">
                                <div class="col-1"><button type="button" class="btn btn-danger btn-sm btn-remove-other" tabindex="-1"><i class="fa fa-trash"></i></button></div>
                                <div class="col-7"><input name="misc_description[]" type="text" class="form-control" placeholder="Description" value="{{ $misc->description ?? '' }}" required></div>
                                <div class="col-4"><input name="misc_price[]" type="number" class="form-control text-right input-other summary-input-group" placeholder="0" value="{{ $misc->price ?? 0 }}" required></div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </div>

    <div class="card border border-info">
        <div class="card-header bg-info">
            <h4 class="card-title text-light d-flex align-items-center">
                Payment Details
            </h4>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <div class="row align-items-center mb-2">
                        <div class="col-5">
                            <label class="font-weight-normal" for="discount">Discount:</label>
                        </div>

                        <div class="col-7">
                            <input type="number" class="form-control text-right payment-input-group" id="discount" name="discount" value="{{ $quotation->discount ?? '' }}" placeholder="0">
                        </div>
                    </div>

                    <div class="row align-items-center mb-2">
                        <div class="col-5">
                            <label class="font-weight-normal" for="subtotal">Subtotal:</label>
                        </div>

                        <div class="col-7">
                            <input type="number" class="form-control text-right payment-input-group" id="subtotal" placeholder="0" value="{{ $quotation->subtotal ?? 0 }}" disabled>
                        </div>
                    </div>

                    <div class="row align-items-center mb-2">
                        <div class="col-5">
                            <label class="font-weight-normal" for="is_vat" role="button">
                                <input type="checkbox" value="1" id="is_vat" class="payment-input-group" role="button" name="is_vat" {{ isset($quotation) && $quotation->is_vat ? 'checked' : '' }}> VAT (12%):
                            </label>
                        </div>

                        <div class="col-7">
                            <input type="number" class="form-control text-right" id="input_vat" placeholder="0" value="{{ $quotation->vat ?? 0 }}" disabled>
                        </div>
                    </div>

                    <div class="row align-items-center mb-2">
                        <div class="col-5">
                            <label class="font-weight-normal" for="total">Total:</label>
                        </div>

                        <div class="col-7">
                            <input type="number" class="form-control text-right" id="total" placeholder="0" value="{{ $quotation->total ?? 0 }}" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-md">
                    <div class="row align-items-center mb-2">
                        <div class="col-5">
                            <label class="font-weight-normal" for="payment_method">Payment Method: <span class="text-danger">*</span></label>
                        </div>

                        <div class="col-7">
                            <select name="payment_method" id="payment_method" class="form-control payment-input-group" required>
                                <option value="" disabled selected>Select payment</option>
                                <option {{ isset($quotation) && $quotation->payment_method == "Cash" ? 'selected' : '' }}>Cash</option>
                                <option {{ isset($quotation) && $quotation->payment_method == "Check" ? 'selected' : '' }}>Check</option>
                                <option {{ isset($quotation) && $quotation->payment_method == "Credit Card Online Payment" ? 'selected' : '' }}>Credit Card Online Payment</option>
                            </select>
                        </div>
                    </div>

                    <div class="row align-items-center mb-2">
                        <div class="col-5">
                            <label class="font-weight-normal" for="grand_total">Grand Total:</label>
                        </div>

                        <div class="col-7">
                            <input type="number" class="form-control text-right" id="grand_total" placeholder="0" value="{{ $quotation->grand_total ?? 0 }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border border-info">
        <div class="card-header bg-info">
            <h4 class="card-title text-light d-flex align-items-center">
                Notes
            </h4>
        </div>

        <div class="card-body">
            <textarea id="summernote" style="display: none;" name="notes">{!! $quotation->notes ?? '' !!}</textarea>
            <input type="hidden" value="{{ $quotation->image_prefix ?? '' }}" name="image_prefix" id="image_prefix">
        </div>
    </div>

    <div class="text-center pb-4">
        <button type="submit" class="btn btn-primary">
            {{ $btnSubmitText ?? 'Submit' }}
        </button>
    </div>
</div>