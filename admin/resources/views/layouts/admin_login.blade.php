<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- Mirrored from www.wrraptheme.com/templates/compass/html/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 30 Jan 2020 09:33:08 GMT -->
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="{{ $title }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <!-- Favicon-->
    <link rel="icon" type="image/svg" sizes="16x16" href="{{URL::to('img/logo.png')}}">
    <!-- Custom Css -->
    {{ Html::style('css/admin/bootstrap.min.css') }}
    {{ Html::style('css/admin/main.css') }}
    {{ Html::style('css/admin/authentication.css') }}
    {{ Html::style('css/admin/color_skins.css') }}
    {{ Html::style('css/admin/developer.css') }}
    {{ Html::style('css/admin/toastr.min.css') }}
    {{ Html::style('css/admin/jquery-confirm/jquery-confirm.css') }}
    {{ Html::script('js/admin/jquery.min.js', ['type' => 'text/javascript']) }}
    {{ Html::script('js/admin/toastr.min.js', ['type' => 'text/javascript']) }}
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
@if(Route::currentRouteName() == "exam" || Route::currentRouteName() == "washer.signUp")
    <body class="theme-cyan sidebar-collapse">
@else   
    <body class="theme-cyan authentication sidebar-collapse">
@endif
<!-- End Navbar -->
<div class="page-header1">
    <div class="page-header-image login_sign_sec" style="background-image:url({{URL::to('img/login.jpg')}})">
        <div class="container">
            <div class="card-plain ">
                @yield('content')
            </div>
        </div>
    </div>
</div>
</body>

<!-- Jquery Core Js -->
{{ Html::script('js/admin/libscripts.bundle.js', ['type' => 'text/javascript']) }}
{{ Html::script('js/admin/vendorscripts.bundle.js', ['type' => 'text/javascript']) }}
{{ Html::script('js/admin/jquery-confirm/jquery-confirm.js', ['type' => 'text/javascript']) }}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.36/jquery.form-validator.min.js"></script>
{{ Html::script('js/admin/validate.js', ['type' => 'text/javascript']) }}
@include('includes.message')
@include('includes._fcm')
<script type="text/javascript">
    $(".allownumericwithdecimal").on("keypress keyup blur",function(e){$(this).val($(this).val().replace(/[^0-9\.]/g,"")),46==e.which&&-1==$(this).val().indexOf(".")||!(e.which<48||e.which>57)||e.preventDefault()});
    $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } });
    $("form").submit(function(){$("#submitButton").prop("disabled",!0),$("#submitButton").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...')});
    $(document).ready(function(){$(".login_sign_sec").css("min-height",$(window).outerHeight())}),$(window).resize(function(){$(".login_sign_sec").css("min-height",$(window).outerHeight())});
</script>
</html>