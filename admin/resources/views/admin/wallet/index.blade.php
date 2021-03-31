
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
                    <li class="breadcrumb-item active">Customers</li>
                </ul>
            </div>
        </div>
</div>
<div class="container-fluid">
@if($data->count() || $request->query('keyword') || $request->query('email')|| $request->query('investmentCapital') || $request->query('created_at_from') || $request->query('created_at_to') || $request->query('status') || $request->query('plan') || $request->query('is_kyc'))
    <div class="row no-gutters">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="body">
                {{ Form::model($user, ['url' => route('admin.wallet'),'class' => 'search_form','method'=>'get']) }}
                    <div class="row table_search_form align-items-center">
                        <div class="col input_feild py-1">
                            {{ Form::text('keyword',null , array_merge(['class' =>'form-control','placeholder'=>__('Search by name, email, phone number')])) }}
                        </div>
                        <div class="col py-1">{{ Form::button('<i class="fas fa-search"></i>',['class'=>'btn btn-secondary float-left','id'=>'submitButton','type'=>'submit']) }}</div>
                        <div class="col py-1">{{ link_to( route('admin.wallet'),'<i class="fas fa-redo-alt"></i>',['class'=>'btn btn-danger'],null, false)}}</div>
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
                @if($data->count() || $request->query('keyword') || $request->query('email')|| $request->query('investmentCapital') || $request->query('created_at_from') || $request->query('created_at_to') || $request->query('status') || $request->query('plan') || $request->query('is_kyc'))
                    @if($data->count())
                        <table class="table table-hover m-b-0">
                            <thead>
                                <tr>
                                    <th>@sortablelink('first_name',__('Name '))</th>
                                    <th>@sortablelink('email',__('Email '))</th>
                                    <th>@sortablelink('number',__('Mobile '))</th>
                                    <th>{{__('Closing Balance')}}</th>
                                    <th width="15%">@sortablelink('created_at',__('created At '))</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('admin.wallet.list')
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
<script>
    $(".date").bootstrapMaterialDatePicker({weekStart:0,time:!1,maxDate:new Date}).on("change",function(e,t){$(this).focus(),$(this).next().removeClass("date_feild_close").addClass("date_feild_close_show")});
    $(document).on("click",".date_feild_close_show",function(){$(this).prev().val(""),$(this).removeClass("date_feild_close_show").addClass("date_feild_close")});
    $(document).on("change",".status_click",function(t){t.preventDefault();var c=$(this).data("url"),e=$(this).prop("checked");console.log($(this).prop("checked")),$.ajax({url:c,data:{status:e},type:"get",success:function(t){}})});
</script>
@stop
