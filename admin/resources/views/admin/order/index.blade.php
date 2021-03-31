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
                    <li class="breadcrumb-item"><a href="{{route('admin.order')}}"> {{__('Report')}}</a></li>
                    <li class="breadcrumb-item active">{{$title}}</li>
                </ul>
            </div>
        </div>
</div>

<div class="container-fluid">
    <div class="row no-gutters">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <ul class="row profile_state list-unstyled">
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{$totalQty}}</h4>
                            <span>Total Qty</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($totalAmount,2)}}</h4>
                            <span>Total Invested</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{$currentQty}}</h4>
                            <span>Current Qty</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($currentAmount,2)}}</h4>
                            <span>Current Invested</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div> 
    </div> 
</div>
 

    <div class="container-fluid">
        @if($data->count() || $request->query('keyword') || $request->query('created_at_from') || $request->query('created_at_to'))
            <div class="row no-gutters">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            {{ Form::model($orderData, ['url' => route('admin.order'),'class' => 'search_form','method'=>'get']) }}
                                <div class="row table_search_form align-items-center">
                                    <div class="col input_feild py-1">
                                        {{ Form::text('keyword',null , array_merge(['class' =>'form-control','placeholder'=>__('Search by user, plan')])) }}
                                    </div>
                                    <div class="col date_feild py-1">
                                        {{ Form::text('created_at_from',null , array_merge(['id'=>'date','class' =>'form-control date','placeholder'=>__('From'),'readonly'=>true])) }}
                                        <a href="javascript:void(0)" class="{{isset($booking['created_at_from']) ? 'date_feild_close_show': 'date_feild_close'}}"><i class="fas fa-times-circle"></i></a>
                                    </div>
                                    <div class="col date_feild py-1">
                                        {{ Form::text('created_at_to',null , array_merge(['class' =>'form-control date','placeholder'=>__('To'),'readonly'=>true])) }}
                                        <a href="javascript:void(0)" class="{{isset($booking['created_at_to']) ? 'date_feild_close_show': 'date_feild_close'}}"><i class="fas fa-times-circle"></i></a>
                                    </div>
                                    <div class="col py-1">{{ Form::button('<i class="fas fa-search"></i>',['class'=>'btn btn-secondary float-left','id'=>'submitButton','type'=>'submit']) }}</div>
                                    <div class="col py-1">{{ link_to( route('admin.order'),'<i class="fas fa-redo-alt"></i>',['class'=>'btn btn-danger'],null, false)}}</div>
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
                    @if($data->count() || $request->query('keyword') || $request->query('created_at_from') || $request->query('created_at_to'))
                        @if($data->count())
                            <table class="table table-hover m-b-0">
                                <thead>
                                    <tr>
                                        <th>Plan</th>
                                        <th>@sortablelink('user',__('User '))</th>
                                        <th>@sortablelink('qty',__('Qty '))</th>
                                        <th>@sortablelink('amount',__('Avg '))</th>
                                        <th>@sortablelink('amount',__('Subscription '))</th>
                                        <th>Total</th>
                                        <th>@sortablelink('is_pms',__('PMS Status '))</th>
                                        <th>@sortablelink('created_at',__('created At '))</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($data->count())
                                        @foreach($data as $key => $value)
                                            <tr>
                                                <td>{{$value->plan->title}}</td>
                                                <td>  
                                                    {{ link_to('#javascript:void(0)',$value->user->fullName,['data-title'=>$value->user->fullName,'data-url'=>route('admin.customer.view', ['id' => Helper::encode($value->user->id)]),'onclick'=>'return false;','class'=>'',],null, false)}}&nbsp;
                                                </td>
                                                <td> {{$value->qty}}</td>
                                                <td>{{number_format($value->amount,2)}}</td>
                                                <td>{{number_format($value->plan->amount +  $value->plan->closing_balance,2)}}</td>
                                                <td>{{number_format($value->amount,2)}}</td>
                                                <td>
                                                    @if($value->is_pms)
                                                        <p class="text-success">Start</p>
                                                    @else
                                                        <p class="text-danger">Stop</p>
                                                    @endif 
                                                </td>
                                                <td>{{Helper::date($value->created_at)}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
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
    $(".date").bootstrapMaterialDatePicker({weekStart:0,time:!1}).on("change",function(e,t){$(this).focus(),$(this).next().removeClass("date_feild_close").addClass("date_feild_close_show")});
    $(document).on("click",".date_feild_close_show",function(){$(this).prev().val(""),$(this).removeClass("date_feild_close_show").addClass("date_feild_close")});
    $(document).on("change",".status_click",function(t){t.preventDefault();var c=$(this).data("url"),e=$(this).prop("checked");console.log($(this).prop("checked")),$.ajax({url:c,data:{status:e},type:"get",success:function(t){}})});
</script>
     
@stop