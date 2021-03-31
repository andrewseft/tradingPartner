@extends('layouts.admin')
@section('content')
<div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>{{$title}}</h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="zmdi zmdi-home"></i>&nbsp; {{__('Home')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.package')}}">{{$title}}</a></li>
                    <li class="breadcrumb-item active">View</li>
                </ul>
            </div>
        </div>
</div>
<div class="container-fluid">
    <div class="row clearfix">
        <div class="card">
            <div class="body">
                @include('includes.admin.language')
                {{ Form::model($package, ['url' => route('admin.package.create'),'class' => 'user','method'=>'post','files' => 'yes']) }}
                    {{ Form::hidden('id')}}
                    {!! Form::hidden($package->image, $package->image, ['id' => 'hidden', 'name' => 'old_image', 'class' => 'text text-hidden']) !!}
                    @include('admin.package.from')
                   
                    <a href="{{route('admin.package')}}" class="btn btn-light">{{__('Back')}}</a>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<!-- end row -->
<script>
    $('.form-control').css('background-color' , '#DEDEDE');
    $(".form-control").attr("disabled", "true");
    $(".status_click").attr("disabled", "true");
</script>
@stop