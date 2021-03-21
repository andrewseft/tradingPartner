@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12 m-b-30">
        <!-- begin page title -->
        <div class="d-block d-sm-flex flex-nowrap align-items-center">
            <div class="page-title mb-2 mb-sm-0">
                <h1>{{$title}}</h1>
            </div>
            <div class="ml-auto d-flex align-items-center">
                <nav>
                    <ol class="breadcrumb p-0 m-b-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}"><i class="ti ti-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.language')}}">{{$title}}</a>
                        </li>
                        <li class="breadcrumb-item  text-primary" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- end page title -->
    </div>
</div>
<!-- begin row -->
<div class="row tabs-contant">
    <div class="col-xxl-12">
        <div class="card card-statistics">
            <div class="card-header">
                <div class="card-heading">
                    <h4 class="card-title">&nbsp;</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="tab nav-bt">
                    {{ Form::model($data, ['url' => route('admin.language.update'),'class' => 'form-horizontal form-material','method' => 'post']) }}
                    @include('admin.language.from')
                        <div class="form-group">
                            <div class="col-sm-12">
                                <a href="{{route('admin.language')}}" class="btn btn-light mb-3 float-right ml-3">Back</a>
                                {{ Form::submit(__('Submit'),['class'=>'btn btn-primary mb-3 float-right']) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@include('includes.admin.ckedit')
@stop