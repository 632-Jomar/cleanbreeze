@extends('layouts.app')

@push('page_scripts')
    <script src="{{ asset('pages/quotations/index.js?v=' . str_random(4)) }}"></script>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1>Quotations</h1>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-8 col-md-6">
                    <form>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search quotation no, client name or sales rep" name="search" value="{{ request('search') }}">
            
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>

                @if (auth()->user()->user_type_id == 2)
                    <div class="col text-right">
                        <a href="{{ route('quotations.create') }}" class="btn btn-success">Create</a>
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
                        <td width="15%" class="align-middle text-center">Quotation <br> No.</td>
                        <td width="15%" class="align-middle text-center">Status</td>
                        <td width="15%" class="align-middle text-center" style="min-width: 150px">Client Name</td>
                        <td width="15%" class="align-middle text-center">Sales Rep.</td>
                        <td width="15%" class="align-middle text-center">Date</td>
                        <td width="15%" class="align-middle text-center">PO</td>

                        @if (auth()->user()->user_type_id == 1)
                            <td class="align-middle text-center">Action</td>
                        @endif
                    </tr>

                    @forelse ($quotations as $quotation)
                        <tr>
                            <td class="align-middle text-center">{{ $quotation->id }}</td>
                            <td class="align-middle text-center">{!! $quotation->status !!}</td>
                            <td class="align-middle text-center">{{ $quotation->name }}</td>
                            <td class="align-middle text-center">{{ $quotation->createdBy->name ?? '' }}</td>
                            <td class="align-middle text-center" style="line-height: 100%"><p class="m-0" style="min-width: 120px">{{ $quotation->created_at->format('d M, Y') }} <br> <span class="text-xs">{{ $quotation->created_at->format('h:i a') }}</span></p></td>
                            <td class="align-middle">
                                <a href="{{ route('quotations.show', $quotation) }}" class="badge badge-success p-2">QUOTATION DETAILS</a>
                            </td>

                            @if (auth()->user()->user_type_id == 1)
                                <td class="align-middle">
                                    <button class="btn btn-danger btn-delete" data-id="{{ $quotation->id }}" title="Delete">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="{{ auth()->user()->user_type_id == 1 ? 7 : 6 }}">No records found.</td>
                        </tr>
                    @endforelse
                </table>
            </div>

            <div class="row justify-content-center">
                {{ $quotations->links() }}
            </div>
        </div>
    </div>
@endsection