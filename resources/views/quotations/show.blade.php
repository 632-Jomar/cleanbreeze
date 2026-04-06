@extends('layouts.app')

@push('page_style')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endpush

@push('page_scripts')
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('pages/quotations/form.js?v=' . str_random(4)) }}"></script>
    <script src="{{ asset('pages/quotations/show.js?v=' . str_random(4)) }}"></script>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-7">
                    <h1>Quotation Details</h1>
                </div>

                <div class="col-5 text-right">
                    <a href="{{ route('quotations.print', $quotation) }}" class="btn btn-info">
                        Print
                    </a>

                    @if (auth()->user()->user_type_id == 1)
                        <button class="btn btn-success" id="btn-approve" data-id="{{ $quotation->id }}" {{ $quotation->has_approved ? 'disabled' : '' }}>
                            {{ $quotation->is_approved ? 'Approved' : 'Approve' }}
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col">
            <div class="card border border-info">
                <div class="card-header bg-info">
                    <h4 class="card-title">Quotation</h4>
                </div>

                <div class="card-body">
                    <div class="row align-items-center mb-2">
                        <div class="col-3 col-lg-2">
                            Quote No:
                        </div>
    
                        <div class="col-9 col-lg-4">
                            <input type="text" class="form-control text-center" value="{{ $quotation->id }}" id="quotation_id" readonly>
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <div class="col-3 col-lg-2">
                            Previous Quote
                        </div>
    
                        <div class="col-9 col-lg-4">
                            <div class="dropdown">
                                <button type="button" class="btn btn-default dropdown-toggle w-100" data-toggle="dropdown">
                                    Select quote
                                </button>

                                <div class="dropdown-menu">
                                    @foreach ($cluster as $item)
                                        <a class="dropdown-item {{ $item->id == $quotation->id ? 'active disabled' : '' }}" href="{{ route('quotations.show', $item) }}">
                                            {{ $item->id }} {{ $item->is_approved ? '(Approved)' : '' }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form id="quotation_form">
            @include('quotations.form')
        </form>
    </section>
@endsection