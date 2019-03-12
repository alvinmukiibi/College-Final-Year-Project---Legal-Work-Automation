<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login | L-WAT</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/owl.transitions.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/morrisjs/morris.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/scrollbar/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/metisMenu/metisMenu.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/metisMenu/metisMenu-vertical.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/calendar/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/calendar/fullcalendar.print.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/form/all-type-forms.css')}}">
    <link rel="stylesheet" href="{{asset('admin/style.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/responsive.css')}}">
    <script src="{{asset('admin/js/vendor/modernizr-2.8.3.min.js')}}"></script>
</head>

<body>
<div class="color-line"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        </div>
    </div>
</div>
<div class="container-fluid" style="padding-top: 50px">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
        <div class="col-md-4 col-md-4 col-sm-4 col-xs-12">
            <div class="text-center m-b-md custom-login">
                <h3>PLEASE LOGIN TO APP</h3>
                <p>This is the best app ever!</p>
            </div>
            <div class="hpanel">
                <div class="panel-body">
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf
                        <div class="form-group">
                            <label class="control-label" for="username">Username</label>
                            <input type="text"  required="" name="user_name" id="username" class="form-control {{ $errors->has('user_name') ? ' is-invalid' : '' }}">
                            @if ($errors->has('user_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="password">Password</label>
                            <input type="password"  required=""  name="password" id="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="checkbox login-checkbox">
                            <label>
                                <input type="checkbox" class="i-checks">{{ __('Remember Me') }} Remember me </label>
                            <p class="help-block small">(if this is a private computer)</p>
                        </div>
                        {{--<button class="">Login</button>--}}
                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-">
                                <button type="submit" class="btn btn-success btn-block loginbtn">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
    </div>
    <div class="row">
        <div class="col-md-12 col-md-12 col-sm-12 col-xs-12 text-center">
            <p>Copyright &copy; {{date('d/m/Y')}} <a href="#">LWAT</a> All rights reserved.</p>
        </div>
    </div>
</div>

<script src="{{asset('admin/js/vendor/jquery-1.11.3.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('admin/js/wow.min.js')}}"></script>
<script src="{{asset('admin/js/jquery-price-slider.js')}}"></script>
<script src="{{asset('admin/js/jquery.meanmenu.js')}}"></script>
<script src="{{asset('admin/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('admin/js/jquery.sticky.js')}}"></script>
<script src="{{asset('admin/js/jquery.scrollUp.min.js')}}"></script>
<script src="{{asset('admin/js/scrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('admin/js/scrollbar/mCustomScrollbar-active.js')}}"></script>
<script src="{{asset('admin/js/metisMenu/metisMenu.min.js')}}"></script>
<script src="{{asset('admin/js/metisMenu/metisMenu-active.js')}}"></script>
<script src="{{asset('admin/js/tab.js')}}"></script>
<script src="{{asset('admin/js/icheck/icheck.min.js')}}"></script>
<script src="{{asset('admin/js/icheck/icheck-active.js')}}"></script>
<script src="{{asset('admin/js/plugins.js')}}"></script>
<script src="{{asset('admin/js/main.js')}}"></script>
</body>
</html>
