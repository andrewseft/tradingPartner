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
                    <li class="breadcrumb-item"><a href="{{route('admin.page')}}">{{$title}}</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ul>
            </div>
        </div>
</div>
<div class="container-fluid">
    <div class="row clearfix">
        @include('includes.admin.language')
        <div class="card">
            <div class="body">
                <div class="tab nav-bt">
                    {{ Form::model($page, ['url' => route('admin.page.create'),'class' => 'user','method'=>'post']) }}
                    {{ Form::hidden('id')}}
                        <div class="tab-content">
                            @foreach(Helper::language() as $languagekey => $language)
                                <div class="tab-pane fade py-3 {{ $languagekey == App::getLocale() ? ' active' : '' }} show" id="home-{{$languagekey}}" role="tabpanel" aria-labelledby="home-{{$languagekey}}-tab">
                                    @include('admin.page.from')
                                </div>
                            @endforeach
                        </div>
                        {{ Form::button(__('Update'),['class'=>'btn btn-primary','id'=>'submitButton','type'=>'submit']) }}
                        <a href="{{route('admin.page')}}" class="btn btn-light ml-3">{{__('Back')}}</a
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@include('includes.admin.ckedit')
@stop