<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Auction</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <!-- App css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>
<body class="account-body accountbg">

<!-- Log In page -->
<div class="container">
    <div class="row vh-100 ">
        <div class="col-12 align-self-center">
            <div class="text-center auth-logo-text">
                <h4 class="mt-0 mb-3 mt-5"> <img src="{{ asset('images/laravel-logo.png') }}" alt="logo-large" class="logo-lg logo-dark"> </h4>
            </div> <!--end auth-logo-text-->
            <div class="auth-page">
                <div class="card auth-card shadow-lg">
                    <div class="card-body">
                        <div class="px-3">
                            <div class="text-center auth-logo-text">
                            </div> <!--end auth-logo-text-->
                            <form class="form-horizontal auth-form my-4" action="{{ route('user.login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <div class="input-group mb-3">
                                        <span class="auth-form-icon">
                                            <i class="dripicons-user"></i>
                                        </span>
                                        <input type="text" class="form-control" name="username" id="username" value="{{old('username')}}" placeholder="Enter username">
                                    </div>
                                    @error('username')
                                    <div class="color"><span class="text-danger"> {{ $message }}</span> </div>
                                    @enderror()
                                    @if($message = Session::get('error'))
                                        <div class="color"><span class="text-danger"> {{ $message }}</span> </div>
                                    @endif
                                </div><!--end form-group-->
                                <div class="form-group">
                                    <label for="userpassword">Password</label>
                                    <div class="input-group mb-3">
                                        <span class="auth-form-icon"><i class="dripicons-lock"></i></span>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
                                    </div>
                                    @error('password')
                                    <div class="color" > <span class="text-danger"> {{ $message }}</span> </div>
                                    @enderror()
                                </div><!--end form-group-->
                                <div class="form-group row mt-4">
                                    <div class="col-sm-6">
                                        <div class="custom-control custom-switch switch-success">
                                            <input type="checkbox" class="custom-control-input" id="customSwitchSuccess">
                                            <label class="custom-control-label text-muted" for="customSwitchSuccess">Remember me</label>
                                        </div>
                                    </div><!--end col-->
                                </div><!--end form-group-->
                                <div class="form-group mb-0 row">
                                    <div class="col-12 mt-2">
                                        <button class="btn btn-gradient-primary btn-round btn-block waves-effect waves-light" type="submit">Log in <i class="fas fa-sign-in-alt ml-1"></i></button>
                                    </div><!--end col-->
                                </div> <!--end form-group-->
                            </form><!--end form-->
                        </div>
                        <div class="m-3 text-center text-muted">
                            <p class="">Don't have an account ?  <a href="/register" class="text-primary ml-2">Free Resister</a></p>
                        </div>
                    </div><!--end card-body-->
                </div><!--end card-->
            </div><!--end auth-page-->
        </div><!--end col-->
    </div><!--end row-->
</div><!--end container-->
<!-- End Log In page -->




<!-- jQuery  -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/metismenu.min.js') }}"></script>
<script src="{{ asset('js/waves.js') }}"></script>
<script src="{{ asset('js/feather.min.js') }}"></script>
<script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
