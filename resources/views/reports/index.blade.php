@extends('layouts.app')

@push('page_scripts')
    {{-- <script src="{{ asset('pages/products/index.js') }}"></script> --}}
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>Report</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <form id='quotation-form'>
                                <select name="year" class="form-control mb-2">
                                    @for ($i = date('Y'); date('Y') - $i <= 3 ; $i--)
                                        <option value="{{ $i }}" {{ $i == request('year') ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                        
                                <select name="month" class="form-control mb-2">
                                    <option value="" selected>Select month</option>
                        
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ $i == request('month') ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                                    @endfor
                                </select>
                        
                                <select name="sales_exec" class="form-control">
                                    <option value="" selected>Select sales executive</option>
                        
                                    {{-- @foreach ($salesExec as $salesEx)
                                        <option value="{{ $salesEx }}" {{ $salesEx == request('sales_exec') ? 'selected' : '' }}>{{ $salesEx }}</option>
                                    @endforeach --}}
                                </select>
                        
                                <div class="text-center my-3">
                                    <input type="submit" class="btn btn-primary" value="Load">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr class="bg-info">				
                                        <td class="align-middle text-center" width="10%">ORDER NO.</td>
                                        <td class="align-middle text-center" width="20%">DATE</td>
                                        <td class="align-middle text-center">SALES REP.</td>
                                        <td class="align-middle text-center">CLIENT NAME</td>
                                        <td class="align-middle text-center">PRODUCT TOTAL</td>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($quotations as $quotation)
                                        <tr>
                                            <td>{{ $quotation->id }}</td>
                                            <td>
                                                {{ $quotation->created_at->format('Y, M d') }} <br>
                                                <span class="text-xs">{{ $quotation->created_at->format('(h:i a)') }}</span>
                                            </td>
                                            <td>{{ $quotation->createdBy->name }}</td>
                                            <td>{{ $quotation->name ?? '-' }}</td>
                                            <td class="text-right">{{ number_format($quotation->total_product_cost, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No quotations found</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                                <tfoot>
                                    <tr class="bg-info">				
                                        <td colspan="5" class="text-right"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection