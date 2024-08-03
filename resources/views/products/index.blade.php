@extends('layouts.app')

@push('page_scripts')
    <script src="{{ asset('pages/products/index.js?v=' . str_random(4)) }}"></script>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="{{ route('products.create') }}" class="btn btn-info"><i class="fa fa-cart-plus"></i> Create</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <tr class="bg-info text-light">
                                <td class="align-middle text-center">ID</td>
                                <td class="align-middle text-center">Product<br> Brand</td>
                                <td class="align-middle text-center">Product<br> Name</td>
                                <td class="align-middle text-center">Type</td>
                                <td class="align-middle text-center">Diameter</td>
                                <td class="align-middle text-center">Price</td>
                                <td class="align-middle text-center">Action</td>
                            </tr>
    
                            @forelse ($products as $key => $product)
                                <tr>
                                    <td class="align-middle text-center product_number">{{ $product->id }}.</td>
                                    <td class="align-middle text-center product_brand">{{ $product->productType->productName->productBrand->brand ?? '' }}</td>
                                    <td class="align-middle text-center product_name">{{ $product->productType->productName->category_name ?? '' }}</td>
                                    <td class="align-middle text-center product_type">{{ $product->productType->type ?? '' }}</td>
                                    <td class="align-middle text-center product_diameter">{{ $product->diameter ?? '' }}</td>
                                    <td class="align-middle text-center product_price">₱{{ $product->price ? number_format($product->price, 2) : '0.00' }}</td>
                                    <td class="align-middle text-center">
                                        <button type="button" class="btn btn-block btn-sm btn-success btn-edit" data-id="{{ $product->id }}">
                                            Edit
                                        </button>
    
                                        <button type="button" class="btn btn-block btn-sm btn-danger btn-delete mt-1" data-id="{{ $product->id }}">
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="7" class="text-center">No records found</td>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="edit_product_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title">Product Description</h5>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <div class="modal-body">
                    <form id="edit_product_form">
                        <div class="form-group">
                            <label class="mb-1">Product Brand:</label>
                            <input class="form-control" type="text" id="product_brand" readonly>
                        </div>

                        <div class="form-group">
                            <label class="mb-1">Product Name:</label>
                            <input class="form-control" type="text" id="product_name" readonly>
                        </div>

                        <div class="form-group">
                            <label class="mb-1">Product Type:</label>
                            <input class="form-control" type="text" id="product_type" readonly>
                            <input type="hidden" name="product_type_id" id="product_type_id">
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label class="mb-1">Diameter:</label>
                                    <input class="form-control" type="text" name="diameter" id="diameter" required>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label class="mb-1">Price:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text text-muted">₱</span>
                                        </div>

                                        <input class="form-control text-right" type="number" step="any" name="price" id="price" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="m-t-50 text-center">
                            <button class="btn btn-primary submit-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection