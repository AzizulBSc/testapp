<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> @yield('title','Role Admin')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('backend.layouts.partials.css')
    @yield('page-css')
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf
                    <div class="login-form-head">
                        <h4>Sign In</h4>
                        <p>Hello there, Sign in and start managing your Admin Template</p>
                    </div>
                    <div class="login-form-body">
                        @include('backend.layouts.partials.message')
                        <div class="form-gp">
                            <label for="email">Email address</label>
                            <input type="email" id="email" class = "@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <i class="ti-email"></i>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-gp">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" autofocus>
                            <i class="ti-lock"></i>
                             @error('password')
                            <div class="text-danger">{{ $message }}</div>
                             @enderror
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="form-check custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="form-check-input custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                             @if (Route::has('password.request'))
                                <a href="{{ route('admin.password.reset') }}">Forgot Password?</a>
                                @endif
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit"> {{ __('Login') }}<i class="ti-arrow-right"></i></button>
                            <div class="login-other row mt-4">
                                {{-- <div class="col-6">
                                    <a class="fb-login" href="#">Log in with <i class="fa fa-facebook"></i></a>
                                   </div> --}}
                                <div class="col-6">
                                    {{-- @if (Route::has('password.request'))
                                    <a class="google-login" href="{{ route('admin.password.reset') }}">{{ __('Forgot Your Password?') }}</a>
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                        {{-- <div class="form-footer text-center mt-5">
                            <p class="text-muted">Don't have an account? <a href="register.html">Sign up</a></p>
                        </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

@include('backend.layouts.partials.js')
@yield('page-js')
</body>

</html>
