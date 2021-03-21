
@extends('layouts.admin')
@section('content')
{{ Html::style('css/admin/bootstrap-material-datetimepicker.css') }}
{{ Html::script('js/admin/moment.js', ['type' => 'text/javascript']) }}
{{ Html::script('js/admin/bootstrap-material-datetimepicker.js', ['type' => 'text/javascript']) }}
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
                <div class="body">
                    @if($data->count())
                        @if($data->count())
                            {{ link_to('#javascript:void(0)','Clear All',['data-title'=>'Clear All ?','data-url'=>route('admin.notification.deleteAll'),'onclick'=>'return false;','class'=>'btn btn-default float-right delete_item mb-3'],null, false)}}
                        @endif
                    <ul class="publications_list mb-0">
                            @foreach ($data as $value)
                                <li class="card publications_list_panel mb-2">
                                    <div class="publications_list_header">
                                        <div class="d-flex align-items-center border-left-0 border-right-0 position-relative">
                                            @if($value->status == 0)
                                                <div class="card-header accordian-arrow d-inline-flex align-items-center justify-content-center" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <span></span>
                                                </div>
                                            @endif
                                            @if($value->status == 1)
                                                <div class="card-header accordian_arrow_show d-inline-flex align-items-center justify-content-center" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                    <span></span>
                                                </div>
                                            @endif
                                            <div class="d-block d-md-inline-flex align-items-center flex-fill">
                                                <div class="d-inline-flex align-items-center">
                                                    
                                                    <div class="publications_list_name  d-block d-md-inline-flex px-4 flex-column">
                                                        <div class="list-name-title">
                                                            <div class="list-name-title-inner" id="listtitle01">{{$value->title}}</div>
                                                        </div>
                                                        <div class="created-date text-capitalize">{!! $value->message !!}</div>
                                                    </div>
                                                </div>
                                                <div class="d-block d-md-inline-flex justify-content-end flex-fill pl-3 pl-sm-2 pl-md-4 ml-3 ml-sm-2 mr-2 mr-lg-5">
                                                    <div class="d-inline-flex align-items-center">
                                                        <span>{{$value->created_at->diffForHumans()}}</span>
                                                    </div>

                                                </div>
                                                <div class="mr-md-5 mr-4 mt-3 mt-md-0">
                                                    <div class="manage-images-edit-icons w-auto mr-4">
                                                        <ul class="manage-images-edit-icons-inner">
                                                            {{ link_to('#javascript:void(0)','<i class="fa fa-trash"></i>',['data-title'=>Helper::mb_strtolower($value->title).' ?','data-url'=>route('admin.notification.delete', ['id' => Helper::encode($value->id)]),'onclick'=>'return false;','class'=>'btn btn-default waves-effect waves-float delete_item'],null, false)}}
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <center class=" mb-4 mt-2">
                            {!! Html::image('img/confused.png','user',['class'=>'img-circle','width'=>60])  !!}
                            <h5 class="pt-4">{{__('There is No Records for Now')}}</h5>
                            <div class="col-sm-6 col-md-4 col-lg-2">
                            </div>
                        </center>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@stop
