<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> @yield('title','Role Admin')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('backend.layouts.partials.css')
    @yield('page-css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- preloader area start -->
{{--<div id="preloader">--}}
{{--    <div class="loader"></div>--}}
{{--</div>--}}
<!-- preloader area end -->
<!-- page container area start -->
<div class="page-container">
   @include('backend.layouts.partials.sidebar')
    <!-- main content area start -->
    <div class="main-content">
        @include('backend.layouts.partials.header')
        @yield('content')
    </div>
    <!-- main content area end -->
    @include('backend.layouts.partials.footer')
</div>
<!-- page container area end -->
@include('backend.layouts.partials.offset')
@include('backend.layouts.partials.js')
@yield('page-js')
</body>

</html>
