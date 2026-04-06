@extends('layouts.app')

@push('page_style')
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
@endpush

@push('page_scripts')
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('pages/quotations/form.js?v=' . str_random(4)) }}"></script>
    <script src="{{ asset('pages/quotations/create.js?v=' . str_random(4)) }}"></script>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Create Quotation</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <form id="quotation_form">
            @include('quotations.form')
        </form>
    </section>
@endsection