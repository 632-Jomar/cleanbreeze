@extends('layouts.app')

@push('page_scripts')
    <script src="{{ asset('pages/products/create.js') }}"></script>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Adding Product</h3>
                        </div>

                        <div class="card-body">
                            <form id="add_product_form">
                                <div class="form-group">
                                    <label for="product_brand_id">Product Brand <span class="text-danger">*</span></label>
                                    <select name="product_brand_id" id="product_brand_id" class="form-control" required>
                                        <option value="" disabled selected>Select brand</option>

                                        @foreach ($productBrands as $productBrand)
                                            <option value="{{ $productBrand->id }}">{{ $productBrand->brand }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="product_name_list">Product Name <span class="text-danger">*</span></label>
                                    <input type="list" list="product_name_datalist" class="form-control" id="product_name_list" name="product_name" autocomplete="off" required>

                                    <datalist id="product_name_datalist"></datalist>
                                </div>

                                <div class="form-group">
                                    <label for="product_type_list">Product Type: <span class="text-danger">*</span> <small>(Note: If there is no Product Type, select "Default Type")</small></label>
                                    <input type="list" list="product_type_datalist" class="form-control" id="product_type_list" name="product_type" autocomplete="off" required>
    
                                    <datalist id="product_type_datalist"></datalist>
                                </div>

                                <div class="form-group">
                                    <label for="diameter">Diameter <span class="text-danger">*</span></label>
                                    <input id="diameter" type="text" class="form-control" name="diameter" required>
                                </div>

                                <div class="form-group">
                                    <label for="price">Price (Php)<span class="text-danger">*</span></label>
                                    <input id="price" type="number" step="any" class="form-control" name="price" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Save Product
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">Adding Category</div>
                        <div class="card-body">
                            <form id="add_category_form">
                                <div class="form-group">
                                    <label for="product_name_id">Product Name <span class="text-danger">*</span></label>
                                    <select name="product_name_id" id="product_name_id" class="form-control" required>
                                        <option value="" disabled selected>Select name</option>

                                        @foreach ($productNames as $productName)
                                            <option value="{{ $productName->id }}">{{ $productName->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="product_type_id">Product Type: <span class="text-danger">*</span></label>
                                    <select name="product_type_id" id="product_type_id" class="form-control" required>
                                        <option value="" disabled selected>Select type</option>
                                    </select>
                                </div>

                                <label>CATEGORIES:</label>

                                <div class="form-group group-checkbox">
                                    <label for="is_power" role="button">
                                        <input type="checkbox" class="category-checkbox" id="is_power"> Motor / Power
                                    </label>

                                    <div class="row">
                                        <div class="col"><input type="text" class="form-control category-input" name="voltage" placeholder="Motor" required disabled></div>
                                        <div class="col"><input type="number" step="any" class="form-control category-input" name="voltage_price" placeholder="Price" disabled></div>
                                    </div>
                                </div>

                                <div class="form-group group-checkbox">
                                    <label for="is_mount" role="button">
                                        <input type="checkbox" class="category-checkbox" id="is_mount"> Mount
                                    </label>

                                    <div class="row">
                                        <div class="col"><input type="text" class="form-control category-input" name="extension" placeholder="Mount" required disabled></div>
                                        <div class="col"><input type="number" step="any" class="form-control category-input" name="extension_price" placeholder="Extension Price" disabled></div>
                                    </div>
                                </div>

                                <div class="form-group group-checkbox">
                                    <label for="is_led" role="button">
                                        <input type="checkbox" class="category-checkbox" id="is_led"> LED
                                    </label>

                                    <div class="row">
                                        <div class="col"><input type="text" class="form-control category-input" name="led" placeholder="LED" required disabled></div>
                                        <div class="col"><input type="number" step="any" class="form-control category-input" name="led_price" placeholder="LED Price" disabled></div>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i> Save Category
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection