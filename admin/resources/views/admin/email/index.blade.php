
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
                    <li class="breadcrumb-item active">{{$title}}</li>
                </ul>
            </div>
        </div>
</div>
<div class="container-fluid">
@if($data->count() || $request->query('title'))
    <div class="row no-gutters">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="body">
                {{ Form::model($email, ['url' => route('admin.email'),'class' => 'search_form','method'=>'get']) }}
                    <div class="row table_search_form align-items-center">
                        <div class="col input_feild py-1">
                            {{ Form::text('title',null , array_merge(['class' =>'form-control','placeholder'=>__('Search by title')])) }}
                        </div>
                        <div class="col py-1">{{ Form::button('<i class="fas fa-search"></i>',['class'=>'btn btn-secondary float-left','id'=>'submitButton','type'=>'submit']) }}</div>
                        <div class="col py-1">{{ link_to( route('admin.email'),'<i class="fas fa-redo-alt"></i>',['class'=>'btn btn-danger'],null, false)}}</div>
                    </div>
                {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endif
    <div class="row clearfix">
        <div class="col-lg-12 pb-3">
            @if($data->count())
                @include('includes.admin.pagination')
            @endif
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card product_item_list">
                <div class="body table-responsive">
                @if($data->count() || $request->query('title'))
                    @if($data->count())
                        <table class="table table-hover m-b-0">
                            <thead>
                                <tr>
                                    <th>@sortablelink('title',__('Title '))</th>
                                    <th>@sortablelink('subject',__('Subject '))</th>
                                    <th>@sortablelink('created_at',__('created At '))</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('admin.email.list')
                            </tbody>
                        </table>
                    @else
                        @include('includes.admin.notFound')
                    @endif
                @else
                    <center class=" mb-4 mt-2">
                        {!! Html::image('img/confused.png','user',['class'=>'img-circle','width'=>60])  !!}
                        <h5 class="pt-4">{{__('There is No Records for Now')}}</h5>
                    </center>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop
