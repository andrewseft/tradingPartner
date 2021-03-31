<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- Mirrored from www.wrraptheme.com/templates/compass/html/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 30 Jan 2020 09:33:08 GMT -->
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="404">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>404</title>
    <!-- Favicon-->
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::to('img/favicon.ico')}}">
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
</head>
<body class="theme-cyan authentication sidebar-collapse">
<!-- End Navbar -->
<div class="page-header">
    <div class="page-header-image" style="background-image:url({{URL::to('img/login.jpg')}})"></div>
    <div class="container">
        <div class="col-md-12 content-center">
            <div class="card-plain">
                <form class="form" method="" action="#">
                    <div class="header">
                        <div class="logo-container">
                            {!! Html::image('img/logo.png') !!}
                        </div>
                        <div class="pt-5">
                            <h5 class="mb-2"><strong>404 Page Not Found</strong></h5>
                            <p>{{__('Well this is awkward, the page you were trying to view does not exist.')}}</p>
                        </div>
                    </div>
                    <div class="footer text-center">
                        {!! Html::decode(link_to_route('admin.dashboard',__('GO TO HOMEPAGE'),null,['class'=>'btn l-cyan btn-round btn-lg btn-block waves-effect waves-light'],false))!!}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

<!-- Jquery Core Js -->
{{ Html::script('js/admin/libscripts.bundle.js', ['type' => 'text/javascript']) }}
{{ Html::script('js/admin/vendorscripts.bundle.js', ['type' => 'text/javascript']) }}
{{ Html::script('js/admin/jquery-confirm/jquery-confirm.js', ['type' => 'text/javascript']) }}
{{ Html::script('js/admin/validate.js', ['type' => 'text/javascript']) }}
@include('includes.message')

</html>