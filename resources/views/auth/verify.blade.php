@extends('layouts.main')

@section('content')
    <div style="width: 460px;">
        <div class="card border">
            <div class="card-header text-center">
                <a class="h2"><span class="text-dark">Clean</span><span class="text-info">breeze</span></a>
            </div>

            <div class="card-body">
                @if (session('verified'))
                    <div class="alert alert-success">
                        <h6><i class="icon fas fa-check"></i> Verified!</h6>
                        <p>{{ session('verified') }}</p>

                        <a href="{{ route('login') }}">Go to Login</a>
                    </div>

                @elseif (!isset($verification) || (isset($verification) && $verification->is_expired))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h6><i class="icon fas fa-ban"></i>Link Expired!</h6>
                        You may contact admin for assistance.
                    </div>

                    <div class="text-center mt-4">
                        <button class="btn btn-primary" style="width: 200px">
                            Go to Login
                        </button>
                    </div>

                @else
                    <form action="{{ route('users.verify', request('token')) }}" method="POST">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" value="{{ request('email') }}" placeholder="Email" maxlength="45" autocomplete="off" readonly>

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" maxlength="45" required>

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" maxlength="45" required>

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4 mb-1">
                            <button class="btn btn-primary" style="width: 200px">
                                Update Password
                            </button>
                        </div>
                    </form>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h6><i class="icon fas fa-ban"></i> Error!</h6>

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection