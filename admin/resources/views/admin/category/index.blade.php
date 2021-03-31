
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
@if($data->count() || $request->query('keyword') || $request->query('created_at_from')|| $request->query('layout_place') || $request->query('status') || $request->query('created_at_to'))
    <div class="row no-gutters">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="body">
                    {{ Form::model($category, ['url' => route('admin.category'),'class' => 'search_form','method'=>'get']) }}
                        <div class="row table_search_form align-items-center">
                            <!-- <div class="col input_feild py-1">
                                {{ Form::text('keyword',null , array_merge(['class' =>'form-control','placeholder'=>__('Search by title')])) }}
                            </div>
                            <div class="col status_feild py-1">
                                {{ Form::select('status',[1=>'Active',2=>'Deactive'],null, ['class'=>'form-control','placeholder'=>__('Select Status')]) }}
                            </div>
                            <div class="col date_feild py-1">
                                {{ Form::text('created_at_from',null , array_merge(['id'=>'date','class' =>'form-control date','placeholder'=>__('From'),'readonly'=>true])) }}
                                <a href="javascript:void()" class="date_feild_close"><i class="fas fa-times-circle"></i></a>
                            </div>
                            <div class="col date_feild py-1">
                                {{ Form::text('created_at_to',null , array_merge(['class' =>'form-control date','placeholder'=>__('To'),'readonly'=>true])) }}
                            </div>
                            <div class="col py-1">{{ Form::button('<i class="fas fa-search"></i>',['class'=>'btn btn-secondary float-left','id'=>'submitButton','type'=>'submit']) }}</div>
                            <div class="col py-1">{{ link_to( route('admin.category'),'<i class="fas fa-redo-alt"></i>',['class'=>'btn btn-danger'],null, false)}}</div> -->
                            <div class="col py-1">{{ link_to( route('admin.category.add'),'<i class="fas fa-plus"></i>',['class'=>'btn btn-success','data-toggle'=>'tooltip','data-original-title'=>__('Add New')],null, false)}}</div>
                            <div class="col py-1">{{ link_to( route('admin.category.sortable'),'<i class="fas fa-align-justify"></i>',['class'=>'btn btn-secondary','data-toggle'=>'tooltip','data-original-title'=>__('Sortable')],null, false)}}</div>
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
                <div class="body">
                @if($data->count() || $request->query('keyword') || $request->query('created_at_from')|| $request->query('layout_place') || $request->query('status') || $request->query('created_at_to'))
                    @if($data->count())
                        <ul class="publications_list mb-0">
                            @foreach ($data as $category)
                                <li class="card publications_list_panel mb-2">
                                    <div class="publications_list_header">
                                        <div class="d-flex align-items-center border-left-0 border-right-0 position-relative">
                                            <div class="card-header accordian-arrow d-inline-flex align-items-center justify-content-center" data-toggle="collapse" data-target="#collapse_{{$category->id}}" aria-expanded="true" aria-controls="collapseOne">
                                                <span>
                                                    @if(0 > 0)
                                                        <i class="fas fa-caret-right"></i>
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="d-block d-md-inline-flex align-items-center flex-fill">
                                                <div class="d-inline-flex align-items-center">
                                                     
                                                    <div class="publications_list_name  d-block d-md-inline-flex px-4 flex-column">
                                                        <div class="list-name-title">
                                                            <div class="list-name-title-inner" id="listtitle01">{{ $category->detail->name }}</div>
                                                        </div>
                                                        <div class="created-date text-capitalize">Created: <span>{{Helper::date($category->created_at)}}</span></div>
                                                    </div>
                                                </div>
                                                <div class="d-block d-md-inline-flex justify-content-end flex-fill pl-3 pl-sm-2 pl-md-4 ml-3 ml-sm-2 mr-2 mr-lg-5">
                                                    <div class="publications_list_image_count d-inline-flex align-items-center">
                                                        <i class="far fa-folder mt-1 mr-2"></i>0
                                                    </div>
                                                    <div class="publications_list_image_count d-inline-flex align-items-center">
                                                        @if($category->status ==1)
                                                            {{ Form::checkbox('status',null,null, array("data-on"=>"Active","data-off"=>"Deactive",'data-size'=>'sm','class'=>'status_click','data-toggle'=>'toggle','data-style'=>'ios','data-onstyle'=>'success','data-offstyle'=>'danger','checked'=>true,'data-url'=>route('admin.category.process', ['id' => Helper::encode($category->id),'status'=>0]))) }}
                                                        @else
                                                            {{ Form::checkbox('status',null,null, array("data-on"=>"Active","data-off"=>"Deactive",'data-size'=>'sm','class'=>'status_click','data-toggle'=>'toggle','data-style'=>'ios','data-onstyle'=>'success','data-offstyle'=>'danger','checked'=>false,'data-url'=>route('admin.category.process', ['id' => Helper::encode($category->id),'status'=>1]))) }}
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="mr-md-5 mr-4 mt-3 mt-md-0">
                                                    <div class="manage-images-edit-icons w-auto mr-4">
                                                        <ul class="manage-images-edit-icons-inner">
                                                            {!! Html::decode(link_to_route('admin.category.edit','<i class="fa fa-edit"></i>', ['id' => Helper::encode($category->id)], ['class'=>'btn btn-default waves-effect waves-float','data-toggle'=>'tooltip','data-original-title'=>__('Edit')])) !!}&nbsp;
                                                            <!-- {{ link_to('#javascript:void(0)','<i class="fa fa-trash"></i>',['data-title'=>$category->detail->name.' ?','data-url'=>route('admin.category.delete', ['id' => Helper::encode($category->id)]),'onclick'=>'return false;','class'=>'btn btn-default waves-effect  waves-float delete_item','data-toggle'=>'tooltip','data-original-title'=>__('Delete')],null, false)}} -->
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
                        @include('includes.admin.notFound')
                    @endif
                @else
                    <center class=" mb-4 mt-2">
                        {!! Html::image('img/confused.png','user',['class'=>'img-circle','width'=>60])  !!}
                        <h5 class="pt-4">{{__('There is No Records for Now')}}</h5>
                        <div class="col-sm-6 col-md-4 col-lg-2">
                            {{ link_to( route('admin.category.add'),__('Create New'),['class'=>'btn btn-raised m-b-10 btn-primary btn-block waves-effect'],null, false)}}
                        </div>
                    </center>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".card-header").click(function(){$(this).find("i").toggleClass("fas fa-caret-right fas fa-caret-down")});
    $('.date').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
    $(document).on("change",".status_click",function(t){t.preventDefault();var c=$(this).data("url"),e=$(this).prop("checked");console.log($(this).prop("checked")),$.ajax({url:c,data:{status:e},type:"get",success:function(t){}})});
</script>
@stop
