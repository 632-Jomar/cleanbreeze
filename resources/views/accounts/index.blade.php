@extends('layouts.app')

@push('page_scripts')
    <script src="{{ asset('pages/accounts/index.js') }}"></script>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Accounts</h1>
                </div>

                <div class="col-sm-6 text-right">
                    <a class="btn btn-info" data-target='#add_account' data-toggle="modal">Create</a>
                </div>
            </div>
        </div>
    </section>

    <div class="content">
        <div class="col">
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <table id="table-accounts" class="table table-bordered">
                            <thead>
                                <tr class="bg-info text-light">
                                    <td class="text-center">#</td>
                                    <td class="text-center">Account Name</td>
                                    <td class="text-center">User Type</td>
                                    <td class="text-center">Email</td>
                                </tr>
                            </thead>
                            
                            <tbody class="bg-white">
                                @include('accounts.tbody')
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="add_account" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create User Account</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <div class="modal-body">
                    <form id="form-add-account" data-url="{{ route('accounts.store') }}">
                        <div class="row align-items-center mb-2">
                            <div class="col-4 text-md">Name <span class="text-danger">*</span></div>
                            <div class="col-8"><input type="text" name="name" class="form-control" autocomplete="off" required></div>
                        </div>

                        <div class="row align-items-center mb-2">
                            <div class="col-4 text-md">Email Address <span class="text-danger">*</span></div>
                            <div class="col-8"><input type="email" name="email" class="form-control" autocomplete="off" required></div>
                        </div>

                        <div class="row align-items-center mb-2">
                            <div class="col-4 text-md">User Type <span class="text-danger">*</span></div>
                            <div class="col-8">
                                <select class="form-control" name="user_type_id" required>
                                    <option value="" disabled selected>Select user type</option>

                                    @foreach ($userTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row align-items-center mb-2">
                            <div class="col-4 text-md">Contact Number</div>
                            <div class="col-8"><input type="text" name="contact_number" class="form-control" autocomplete="off"></div>
                        </div>

                        <div class="mt-4 text-center">
                            <button class="btn btn-primary submit-btn">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection