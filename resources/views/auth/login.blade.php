@extends('layouts.main')

@section('content')
    <div style="width: 460px;">
        <div class="card border">
            <div class="card-header text-center">
                <a class="h2"><span class="text-dark">Clean</span><span class="text-info">breeze</span></a>
            </div>

            <div class="card-body">
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email" maxlength="45" autocomplete="off" required>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-2">
                        <input type="password" name="password" class="form-control" placeholder="Password" maxlength="45" required>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('password.request') }}">Forgot Password?</a>

                    <div class="text-center mt-4">
                        <button class="btn btn-primary" style="width: 150px">
                            Login
                        </button>
                    </div>
                </form>

                @error('email')
                    <div class="alert alert-danger alert-dismissible mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h6><i class="icon fas fa-ban"></i> Error</h6>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="card-footer border-top">
                <div class="text-center">
                    <a href="https://cleanbreezeph.com/" class="mr-2">
                        <i class="fa fa-globe fa-2x text-info"></i>
                    </a>

                    <a href="#" class="mr-2">
                        <i class="fab fa-facebook fa-2x text-info"></i>
                    </a>

                    <a href="mailto:contact@cleanbreezeph.com" class="mr-2">
                        <i class="fa fa-envelope fa-2x text-info"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection