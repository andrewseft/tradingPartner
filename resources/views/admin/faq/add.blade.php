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
                    <li class="breadcrumb-item"><a href="{{route('admin.faq')}}">{{$title}}</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ul>
            </div>
        </div>
</div>
<div class="container-fluid">
    <div class="row clearfix">
        <div class="card">
            <div class="body">
                @include('includes.admin.language')
                {{ Form::model($faq, ['url' => route('admin.faq.create'),'class' => 'user','method'=>'post','files' => 'yes','id'=>'target']) }}
                    {{ Form::hidden('id')}}
                        @include('admin.faq.from')
                    {{ Form::button(__('Submit'),['class'=>'btn btn-primary','id'=>'submitButton','type'=>'submit']) }}
                    <a href="{{route('admin.faq')}}" class="btn btn-light ml-3">{{__('Back')}}</a>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
 
@stop