<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cleanbreeze</title>

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('login-page/login.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="container-fluid">
        <div class="row">
            <div style="width: 80px" class="bg-white vh-100 d-none d-xl-inline-flex">
                <div class="col text-center pt-3">
                    <a href="http://philgeogreen.com/" title="Geogreen Website" class="d-block" style="font-size: 40px">
                        <i class="fa fa-globe text-info"></i>
                    </a>

                    <a href="https://www.facebook.com/Philippine-GeoGreen-Inc-97741785266/" title="Facebook Page" class="d-block" style="font-size: 40px">
                        <i class="fab fa-facebook text-info"></i>
                    </a>
                </div>
            </div>

            <div class="vh-100 flex-fill">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="row vh-100 align-items-center text-light">
                                <div class="w-100">
                                    <div class="col-8 col-md-7 text-center mx-auto">
                                        <img src="/assets/logos/logophil.png" alt="" class="login-company-logo img-fluid" draggable="false">
    
                                        <form action="{{ route('password.email') }}" method="POST" id="form-forget">
                                            @csrf
    
                                            <div class="mb-2">
                                                <label class="font-weight-normal">Email:</label>
                                                <input type="email" name="email" class="form-control" placeholder="Email Address *" value="{{ old('email') }}" required>
                                            </div>
        
                                            <div class="text-center mt-4">
                                                <button type="submit" id="btn-login" class="btn btn-light rounded-pill">
                                                    Send Reset Password Link
                                                </button>
                                            </div>
                                        </form>
                                    </div>
    
                                    <div class="text-center" id="login-error-message">
                                        @if (session('status'))
                                            <p class="mt-3 text-success">{{ session('status') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 bg-white register-div">
                            <div class="row vh-100 justify-content-center align-items-center">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/plugins/jquery/jquery.min.js"></script>
    <script src="/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/dist/js/adminlte.min.js"></script>
    <script src="/login-page/login.js"></script>
</body>
</html>
