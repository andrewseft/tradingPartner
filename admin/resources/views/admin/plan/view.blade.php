@extends('layouts.admin')
@section('content')
{{ Html::style('css/admin/bootstrap-material-datetimepicker.css') }}
{{ Html::script('js/admin/moment.js', ['type' => 'text/javascript']) }}
{{ Html::script('js/admin/bootstrap-material-datetimepicker.js', ['type' => 'text/javascript']) }}
<script type="text/javascript" src="{{Constant::MAP_URL}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
<div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>{{$title}}</h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="zmdi zmdi-home"></i>&nbsp; {{__('Home')}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.plan')}}"> {{__('Paln')}}</a></li>
                    <li class="breadcrumb-item active">{{$title}}</li>
                </ul>
            </div>
        </div>
</div>
<div class="container-fluid">
    <div class="row no-gutters">
    <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="card visitors-map">
                    <div class="body">
                        <div style="width: 99%;">
                            {!! $chart->container() !!}
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card">
                <ul class="row profile_state list-unstyled">
                    <li class="col-lg-6 col-md-6 col-6">
                        <div class="body">
                            <h4>{{Constant::CURRENCY}}&nbsp;{{number_format($plan->amount,2)}}</h4>
                            <span>Issue Price</span>
                        </div>
                    </li>
                    <li class="col-lg-6 col-md-6 col-6">
                        <div class="body">
                            <h4>{{Constant::CURRENCY}}&nbsp;{{number_format($closingBal->current_balance,2)}}</h4>
                            <span>Current Amount</span>
                        </div>
                    </li>
                    <li class="col-lg-6 col-md-6 col-6">
                        <div class="body">
                            <h4>{{Constant::CURRENCY}}&nbsp;{{number_format(($plan->qty + $totalSale)*$plan->amount,2)}}</h4>
                            <span>Market Cap</span>
                        </div>
                    </li>
                    <li class="col-lg-6 col-md-6 col-6">
                        <div class="body">
                            <h4>{{$plan->qty + $totalSale}}</h4>
                            <span>Total Supply</span>
                        </div>
                    </li>
                    <li class="col-lg-6 col-md-6 col-6">
                        <div class="body">
                            <h4>{{$totalSale}}</h4>
                            <span>Sold Qty</span>
                        </div>
                    </li>
                    <li class="col-lg-6 col-md-6 col-6">
                        <div class="body">
                            <h4>{{$plan->qty}}</h4>
                            <span>Available Qty</span>
                        </div>
                    </li>
                    <li class="col-lg-6 col-md-6 col-6">
                        <div class="body">
                            <h4>{{Constant::CURRENCY}}&nbsp;{{number_format($totalSale * $plan->amount,2)}}</h4>
                            <span>Total Investment</span>
                        </div>
                    </li>
                    <li class="col-lg-6 col-md-6 col-6">
                        <div class="body">
                            <h4>{{Constant::CURRENCY}}&nbsp;{{number_format($totalSale * $closingBal->current_balance,2)}}</h4>
                            <span>Current Value</span><br>
                            <span>Gain&nbsp;{{Constant::CURRENCY}}&nbsp;{{number_format(($totalSale * $closingBal->current_balance) - ($totalSale * $plan->amount),2)}}</span>
                        </div>
                    </li>
                    <li class="col-lg-6 col-md-6 col-6">
                        <div class="body">
                            @if($totalSale > 0 )
                                <h4>{{Constant::CURRENCY}}&nbsp;{{round(((($totalSale * $closingBal->current_balance) - ($totalSale * $plan->amount))/($totalSale * $closingBal->current_balance))*100,2)}}%</h4>
                            @else
                                <h4>0%</h4>
                            @endif
                            <span>P&L</span><br>
                            
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
                    {{ Form::model($planData, ['url' => route('admin.plan.view',Helper::encode($plan->id)),'class' => 'search_form','method'=>'get']) }}
                        <div class="row table_search_form align-items-center">
                            <div class="col input_feild py-1">
                                {{ Form::text('keyword',null , array_merge(['class' =>'form-control','placeholder'=>__('Search by user')])) }}
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
                            <div class="col py-1">{{ link_to( route('admin.plan.view',Helper::encode($plan->id)),'<i class="fas fa-redo-alt"></i>',['class'=>'btn btn-danger'],null, false)}}</div>
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
                                    <th>@sortablelink('user',__('User '))</th>
                                    <th>@sortablelink('amount',__('Amount '))</th>
                                    <th>@sortablelink('qty',__('Qty '))</th>
                                    <th>@sortablelink('created_at',__('Issue Date '))</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data->count())
                                    @foreach($data as $key => $value)
                                        <tr>
                                            <td>  
                                                {{ link_to('#javascript:void(0)',$value->user->fullName,['data-title'=>$value->user->fullName,'data-url'=>route('admin.customer.view', ['id' => Helper::encode($value->user->id)]),'onclick'=>'return false;','class'=>'item_view',],null, false)}}&nbsp;
                                            </td>
                                            <td>{{Constant::CURRENCY}}&nbsp;{{number_format($value->amount,2)}}</td>
                                            <td> {{$value->qty}}</td>
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
{!! $chart->script() !!}
<script>
    $(".date").bootstrapMaterialDatePicker({weekStart:0,time:!1,maxDate:new Date}).on("change",function(e,t){$(this).focus(),$(this).next().removeClass("date_feild_close").addClass("date_feild_close_show")});
    $(document).on("click",".date_feild_close_show",function(){$(this).prev().val(""),$(this).removeClass("date_feild_close_show").addClass("date_feild_close")});
    $(document).on("change",".status_click",function(t){t.preventDefault();var c=$(this).data("url"),e=$(this).prop("checked");console.log($(this).prop("checked")),$.ajax({url:c,data:{status:e},type:"get",success:function(t){}})});
</script>
     
@stop