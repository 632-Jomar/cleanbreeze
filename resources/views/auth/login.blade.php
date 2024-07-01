@extends('layouts.auth')

@section('content')
    <div class="col-10 col-sm-9">
        <h3 class="mb-4 text-center text-sm-left">REGISTER AS SALES EXECUTIVE</h3>

        <div class="mb-2">
            <label class="font-weight-normal">First Name:</label>
            <input type="email" class="form-control" placeholder="First Name *">
        </div>

        <div class="mb-2">
            <label class="font-weight-normal">Last Name:</label>
            <input type="email" class="form-control" placeholder="Last Name *">
        </div>

        <div class="mb-2">
            <label class="font-weight-normal">Email:</label>
            <input type="email" class="form-control" placeholder="Email *">
        </div>

        <div class="mb-2">
            <label class="font-weight-normal">Contact #:</label>
            <input type="email" class="form-control" placeholder="Your phone *">
        </div>

        <div class="text-center mt-4">
            <button type="button" class="btn btn-info rounded-pill" style="width: 200px">Register</button>
        </div>
    </div>
@endsection