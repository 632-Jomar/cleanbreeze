@extends('layouts.app')

@push('page_scripts')
    <script src="{{ asset('pages/quotations/index.js') }}"></script>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>Quotations</h1>
                </div>

                @if (auth()->user()->user_type_id == 2)
                    <div class="col text-right">
                        <a href="{{ route('quotations.create') }}" class="btn btn-info">Create</a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <tr class="bg-info text-light">
                        <td class="align-middle text-center">Quotation <br> No.</td>
                        <td class="align-middle text-center">Status</td>
                        <td class="align-middle text-center">Client Name</td>
                        <td class="align-middle text-center">Sales Rep.</td>
                        <td class="align-middle text-center">Date</td>
                        <td class="align-middle text-center">PO</td>

                        @if (auth()->user()->user_type_id == 1)
                            <td class="align-middle text-center">Action</td>
                        @endif
                    </tr>

                    @forelse ($quotations as $quotation)
                        <tr>
                            <td class="align-middle">{{ $quotation->id }}</td>
                            <td class="align-middle">{!! $quotation->status !!}</td>
                            <td class="align-middle">{{ $quotation->name }}</td>
                            <td class="align-middle">{{ $quotation->createdBy->name ?? '' }}</td>
                            <td class="align-middle">{{ $quotation->created_at->format('d M, Y h:i a') }}</td>
                            <td class="align-middle">
                                <a href="{{ route('quotations.show', $quotation) }}" class="badge badge-success p-2">QUOTATION DETAILS</a>
                            </td>

                            @if (auth()->user()->user_type_id == 1)
                                <td class="align-middle">
                                    <button class="btn btn-danger btn-delete" data-id="{{ $quotation->id }}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="6">No records found.</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection