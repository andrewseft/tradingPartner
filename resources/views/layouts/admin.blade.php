<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="{{ $title }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg" sizes="16x16" href="{{URL::to('img/logo.png')}}">

    <title>{{ $title }}</title>
        <!-- Favicon-->
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
{{ Html::script('js/admin/libscripts.bundle.js', ['type' => 'text/javascript']) }}
{{ Html::script('js/admin/vendorscripts.bundle.js', ['type' => 'text/javascript']) }}
{{ Html::script('js/admin/mainscripts.bundle.js', ['type' => 'text/javascript']) }}
{{ Html::script('js/admin/jquery-confirm/jquery-confirm.js', ['type' => 'text/javascript']) }}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.36/jquery.form-validator.min.js"></script>
{{ Html::script('js/admin/validate.js', ['type' => 'text/javascript']) }}
</body>
@include('includes.message')
@include('includes._fcm')
<script type="text/javascript">
    $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } }),
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    }),
    $(".allownumericwithdecimal").on("keypress keyup blur",function(e){$(this).val($(this).val().replace(/[^0-9\.]/g,"")),46==e.which&&-1==$(this).val().indexOf(".")||!(e.which<48||e.which>57)||e.preventDefault()});
    $(document).ready(function(){$(".logout").click(function(){let t=$(this).data("url");$.confirm({theme:"modern",closeIcon:!0,animation:"scale",type:"blue",backgroundDismiss:!0,title:!1,content:'<div class="meme-image"><img src="{{URL::to("img/logo.png")}}" alt="tradingPartner" style="width: 80px;"></div><div class="meme-text" style="font-weight: bold;margin-bottom: 20px;"></div><div><div>{{__("Are you sure you want to logout account?")}}</div>',columnClass:"col-md-6 col-md-offset-3",closeIcon:!0,buttons:{yes:{text:"{{__('Yes')}}",btnClass:"btn-default",keys:["enter","shift"],action:function(){window.location.href=t}},no:{text:"{{__('No')}}",btnClass:"btn-danger",keys:["enter","shift"]}}})}),$(".delete_item").click(function(){let t=$(this).data("url"),e=$(this).data("title");$.confirm({theme:"modern",closeIcon:!0,animation:"scale",type:"blue",backgroundDismiss:!0,title:!1,content:'<div class="meme-image"><img src="{{URL::to("img/logo.png")}}" alt="tradingPartner" style="width: 80px;"></div><div class="meme-text" style="font-weight: bold;margin-bottom: 20px;"></div><div><div>{{__("Are you sure you want to delete this ")}}<b>'+e+"</b></div>",columnClass:"col-md-6 col-md-offset-3",closeIcon:!0,buttons:{yes:{text:"{{__('Yes')}}",btnClass:"btn-default",keys:["enter","shift"],action:function(){window.location.href=t}},no:{text:"{{__('No')}}",btnClass:"btn-danger",keys:["enter","shift"]}}})}),$(".booking_item").click(function(){let t=$(this).data("url"),e=$(this).data("title");$.confirm({theme:"modern",closeIcon:!0,animation:"scale",type:"blue",backgroundDismiss:!0,title:!1,content:'<div class="meme-image"><img src="{{URL::to("img/logo.png")}}" alt="tradingPartner" style="width: 80px;"></div><div class="meme-text" style="font-weight: bold;margin-bottom: 20px;"></div><div><div>{{__("Are you sure you want to approve kyc for ")}}<b>'+e+"</b> ?</div>",columnClass:"col-md-6 col-md-offset-3",closeIcon:!0,buttons:{yes:{text:"{{__('Yes')}}",btnClass:"btn-default",keys:["enter","shift"],action:function(){window.location.href=t}},no:{text:"{{__('No')}}",btnClass:"btn-danger",keys:["enter","shift"]}}})})});
    $("form").submit(function(){$("#submitButton").prop("disabled",!0),$("#submitButton").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...')});
    $(".item_view").click(function(){let t=$(this).data("url"),n=$(this).data("title");$.dialog({theme:"material",closeIcon:!0,animation:"scale",type:"blue",backgroundDismiss:!0,title:n,columnClass: "col-11",containerFluid: true,content:function(){var n=this;return $.ajax({url:t,method:"get"}).done(function(t){n.setContent(t.data)}).fail(function(){n.setContent("Something went wrong.")})}})});
</script>
</html>