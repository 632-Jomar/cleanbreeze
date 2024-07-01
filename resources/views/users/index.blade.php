@extends('layouts.app')

@push('page_scripts')
    <script src="{{ asset('pages/users/index.js') }}"></script>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Profile Details</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col-md-4 text-center">
                            <img id="img-profile-preview" src="{{ auth()->user()->image_src }}" alt="" class="img-fluid img-circle d-block mx-auto mb-3" style="height: 250px; width: 250px">

                            <button class="btn btn-primary mb-3" data-target="#upload_modal" data-toggle="modal">
                                <i class="fa fa-camera"></i> Upload Photo
                            </button>
                        </div>

                        <div class="col-md-8">
                            <h4>Edit Profile</h4>

                            <div class="px-0 px-sm-4 py-2">
                                <form id="update_profile_form" class="mb-3">
                                    <div class="row form-group align-items-center">
                                        <div class="col-4">Name</div>
                                        <div class="col-8"><input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}"></div>
                                    </div>
        
                                    <div class="row form-group align-items-center">
                                        <div class="col-4">Email</div>
                                        <div class="col-8"><input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}"></div>
                                    </div>

                                    <div class="text-center">
                                        <input type="submit" value="Update Info" class="btn btn-primary">
                                    </div>
                                </form><hr>

                                <form id="update_password_form">
                                    <div class="row form-group align-items-center">
                                        <div class="col-5 col-sm-4">Old Password</div>
                                        <div class="col-7 col-sm-8"><input type="password" name="old_password" class="form-control" autocomplete="off" required></div>
                                    </div>

                                    <div class="row form-group align-items-center">
                                        <div class="col-5 col-sm-4">New Password</div>
                                        <div class="col-7 col-sm-8"><input type="password" name="password" class="form-control" autocomplete="off" required></div>
                                    </div>

                                    <div class="row form-group align-items-center">
                                        <div class="col-5 col-sm-4">Confirm Password</div>
                                        <div class="col-7 col-sm-8"><input type="password" name="password_confirmation" class="form-control" autocomplete="off" required></div>
                                    </div>

                                    <div class="text-center">
                                        <input type="submit" value="Update Password" class="btn btn-danger">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="upload_modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Photo</h5>
                </div>

                <div class="modal-body text-center">
                    <form id="upload_form">
                        <input type="file" id="image_profile" name="image_profile" accept="image/*" class="d-block mb-3" required>

                        <button type="submit" class="btn btn-primary">
                            Upload
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection