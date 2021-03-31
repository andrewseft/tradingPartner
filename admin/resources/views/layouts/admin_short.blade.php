<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="{{ $title }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>
        <!-- Favicon-->
    <link rel="icon" type="image/png" sizes="16x16" href="{{URL::to('img/logo.png')}}">
    {{ Html::style('css/admin/bootstrap.min.css') }}
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <!-- Custom Css -->
    {{ Html::style('css/admin/main.css') }}
    {{ Html::style('css/admin/color_skins.css') }}
    {{ Html::style('css/admin/developer.css') }}
    {{ Html::style('css/admin/toastr.min.css') }}
    {{ Html::style('css/admin/bootstrap4-toggle.min.css') }}
    {{ Html::style('css/admin/jquery-confirm/jquery-confirm.css') }}
    {{ Html::script('js/admin/jquery.min.js', ['type' => 'text/javascript']) }}
    {{ Html::script('js/admin/toastr.min.js', ['type' => 'text/javascript']) }}
    {{ Html::script('js/admin/bootstrap4-toggle.min.js', ['type' => 'text/javascript']) }}
</head>

<body class="theme-cyan">
<!-- Page Loader -->
<!-- <div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30">{{HTML::image('img/loader.svg')}}</div>
    </div>
</div> -->

<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- Top Bar -->
<nav class="navbar">
    @include('includes.admin.header')
</nav>
<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    @include('includes.admin.nabar')
</aside>
<!-- Main Content -->
<section class="content home">
    @yield('content')
</section>
<!-- Jquery Core Js -->

</body>
@include('includes.message')
{{ Html::script('js/admin/vendorscripts.bundle.js', ['type' => 'text/javascript']) }}
{{ Html::script('js/admin/mainscripts.bundle.js', ['type' => 'text/javascript']) }}
<script type="text/javascript">
    $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } });
</script>
</html>