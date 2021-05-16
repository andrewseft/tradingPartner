@extends('layouts.admin')
@section('content')
<script type="text/javascript" src="{{Constant::MAP_URL}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{{ Html::style('css/admin/bootstrap-material-datetimepicker.css') }}
{{ Html::script('js/admin/moment.js', ['type' => 'text/javascript']) }}
{{ Html::script('js/admin/bootstrap-material-datetimepicker.js', ['type' => 'text/javascript']) }}
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Dashboard</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
            <div class="row no-gutters">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            {{ Form::model($planData, ['url' => route('admin.dashboard'),'class' => 'search_form','method'=>'get']) }}
                                <div class="row table_search_form align-items-center">
                                    <div class="col date_feild py-1">
                                        {{ Form::text('created_at_from',null , array_merge(['id'=>'date','class' =>'form-control date','placeholder'=>__('From'),'readonly'=>true])) }}
                                        <a href="javascript:void(0)" class="{{isset($planData['created_at_from']) ? 'date_feild_close_show': 'date_feild_close'}}"><i class="fas fa-times-circle"></i></a>
                                    </div>
                                    <div class="col date_feild py-1">
                                        {{ Form::text('created_at_to',null , array_merge(['class' =>'form-control date','placeholder'=>__('To'),'readonly'=>true])) }}
                                        <a href="javascript:void(0)" class="{{isset($planData['created_at_to']) ? 'date_feild_close_show': 'date_feild_close'}}"><i class="fas fa-times-circle"></i></a>
                                    </div>
                                    <div class="col py-1">{{ Form::button('<i class="fas fa-search"></i>',['class'=>'btn btn-secondary float-left','id'=>'submitButton','type'=>'submit']) }}</div>
                                    <div class="col py-1">{{ link_to( route('admin.dashboard'),'<i class="fas fa-redo-alt"></i>',['class'=>'btn btn-danger'],null, false)}}</div>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <ul class="row profile_state list-unstyled">
                <li class="col-lg-3 col-md-3 col-3">
                    <a href="{{route('admin.customer')}}">
                        <div class="body">
                           
                            <h4>{{$totalUser}}</h4>
                            <span>Customers</span>
                        </div>
                    </a>
                </li>
                <li class="col-lg-3 col-md-3 col-3">
                    <a href="{{route('admin.earning')}}">
                        <div class="body">
                            
                            <h4>{{number_format($planform_fee,2)}}</h4>
                            <span>Planform Fee</span>
                        </div>
                    </a>
                </li>
                <li class="col-lg-3 col-md-3 col-3">
                    <a href="{{route('admin.earning')}}">
                        <div class="body">
                            <h4>{{number_format($commission,2)}}</h4>
                            <span>TOTAL REVENUE</span>
                        </div>
                    </a>
                </li>
                <li class="col-lg-3 col-md-3 col-3">
                    <a href="{{route('admin.earning')}}">
                        <div class="body">
                            
                            <h4>{{number_format($total_charges,2)}}</h4>
                            <span>Charges</span>
                        </div>
                    </a>
                </li>
                <li class="col-lg-3 col-md-3 col-3">
                    <a href="javascript:void(0);">
                        <div class="body">
                            <h4>{{$subscriptionQty}}</h4>
                            <span>Plan subscribed Qty</span>
                        </div>
                    </a>
                </li>
                <li class="col-lg-3 col-md-3 col-3">
                    <a href="javascript:void(0);">
                        <div class="body">
                            <h4>{{$redeemQty}}</h4>
                            <span>Plan traded Qty</span>
                        </div>
                    </a>
                </li>
                <li class="col-lg-3 col-md-3 col-3">
                    <a href="javascript:void(0);">
                        <div class="body">
                            
                            <h4>{{number_format($walletAmount,2)}}</h4>
                            <span>Wallet Funds</span>
                        </div>
                    </a>
                </li>
                <li class="col-lg-3 col-md-3 col-3">
                    <a href="javascript:void(0);">
                        <div class="body">
                            <h4>{{number_format($invested,2)}}</h4>
                            <span>Funds Invested</span>
                        </div>
                    </a>
                </li>
                <li class="col-lg-3 col-md-3 col-3">
                    <a href="javascript:void(0);">
                        <div class="body">
                            <h4>{{number_format($withdrawal,2)}}</h4>
                            <span>Withdrawal</span>
                        </div>
                    </a>
                </li>

                <li class="col-lg-3 col-md-3 col-3">
                    <a href="javascript:void(0);">
                        <div class="body">
                            <h4>{{number_format($startPms)}}</h4>
                            <span>User Subscribed</span>
                        </div>
                    </a>
                </li>
                 
                <li class="col-lg-3 col-md-3 col-3">
                    <a href="javascript:void(0);">
                        <div class="body">
                            <h4>{{number_format($stopPms)}}</h4>
                            <span>User Stop</span>
                        </div>
                    </a>
                </li>
                 
                 
            </ul>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Customer Graph</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        {!! $redeemsChart->container() !!}
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Referrals</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        {!! $referralChart->container() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {!! $chart->script() !!}
    {!! $redeemsChart->script() !!}
    {!! $referralChart->script() !!}
    <script>
    $(".date").bootstrapMaterialDatePicker({weekStart:0,time:!1,maxDate:new Date}).on("change",function(e,t){$(this).focus(),$(this).next().removeClass("date_feild_close").addClass("date_feild_close_show")});
    $(document).on("click",".date_feild_close_show",function(){$(this).prev().val(""),$(this).removeClass("date_feild_close_show").addClass("date_feild_close")});
    $(document).on("change",".status_click",function(t){t.preventDefault();var c=$(this).data("url"),e=$(this).prop("checked");console.log($(this).prop("checked")),$.ajax({url:c,data:{status:e},type:"get",success:function(t){}})});
</script>
@stop