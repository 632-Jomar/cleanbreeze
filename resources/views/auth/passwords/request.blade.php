@extends('layouts.main')

@section('content')
    <div style="width: 460px;">
        <div class="card border">
            <div class="card-header text-center">
                <a class="h2"><span class="text-dark">Clean</span><span class="text-info">breeze</span></a>
            </div>

            <div class="card-body">
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email" maxlength="45" autocomplete="off" required>

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4 mb-1">
                        <button class="btn btn-primary" style="width: 250px">
                            Send Reset Link Password
                        </button>
                    </div>

                    <a href="{{ route('login') }}">Login</a>
                </form>

                @error('email')
                    <div class="alert alert-danger alert-dismissible mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h6><i class="fas fa-ban"></i> Error</h6>
                        {{ $message }}
                    </div>
                @enderror

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible mt-4">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h6><i class="fas fa-check"></i> Success</h6>
                        <span style="font-size: 15px">{{ session('status') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection