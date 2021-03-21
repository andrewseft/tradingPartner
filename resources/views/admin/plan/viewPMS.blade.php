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
            <div class="card visitors-map">
                <div class="body">
                    <div style="width: 99%;">
                        {!! $planChart->container() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <ul class="row profile_state list-unstyled">
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($resultData['totalwalletFunds'],2)}}</h4>
                            <span>Total Wallet Funds</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($resultData['subscribedFunds'],2)}}</h4>
                            <span>Subscribed Funds</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($resultData['issuePrice'],2)}}</h4>
                            <span>Issue Price</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($resultData['totalSupply'],2)}}</h4>
                            <span>Total Supply</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($resultData['pl'],2)}}</h4>
                            <span>P&L</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($resultData['earningPerShare'],2)}}</h4>
                            <span>Earning Per Share</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($resultData['change'],2)}}</h4>
                            <span>%Change</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($resultData['userSubscribed'],2)}}</h4>
                            <span>User Subscribed</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($resultData['userStop'],2)}}</h4>
                            <span>User Stop</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($resultData['marketCap'],2)}}</h4>
                            <span>Market Cap</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($resultData['maxSupply'],2)}}</h4>
                            <span>Max Supply (Total Qty)</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($resultData['commision'],2)}}</h4>
                            <span>Income (commision 5%)</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($resultData['taxes'],2)}}</h4>
                            <span>Taxes</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($resultData['finalProfit'],2)}}</h4>
                            <span>Final Profit</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($resultData['currentPrice'],2)}}</h4>
                            <span>Current Price</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($resultData['amountChg'],2)}}</h4>
                            <span>Amount Chg</span>
                        </div>
                    </li>
                    <li class="col-lg-3 col-md-3 col-3">
                        <div class="body">
                            <h4>{{number_format($resultData['chg'],2)}}</h4>
                            <span>% Chg</span>
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
                        {{ Form::model($user, ['url' => route('admin.plan.viewPMS',Helper::encode($plan->id)),'class' => 'search_form','method'=>'get']) }}
                            <div class="row table_search_form align-items-center">
                                <div class="col input_feild py-1">
                                    {{ Form::text('keyword',null , array_merge(['class' =>'form-control','placeholder'=>__('Search by user')])) }}
                                </div>
                                <div class="col py-1">{{ Form::button('<i class="fas fa-search"></i>',['class'=>'btn btn-secondary float-left','id'=>'submitButton','type'=>'submit']) }}</div>
                                <div class="col py-1">{{ link_to( route('admin.plan.viewPMS',Helper::encode($plan->id)),'<i class="fas fa-redo-alt"></i>',['class'=>'btn btn-danger'],null, false)}}</div>
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
                                    <th>User</th>
                                    <th>Total Invested</th>
                                    <th>Qty</th>
                                    <th>Current Value</th>
                                    <th>%Chg</th>
                                    <th>P&L</th>
                                    <th>PMS</th>
                                    <th width="15%">created At</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data->count())
                                    @foreach($data as $key => $value)
                                        @php
                                            $data = Helper::__statement($value->user_id,$value->plan_id);
                                            $pl = 0;
                                            $chg = 0;
                                            foreach($data as $item){
                                                $pl += $item->pl;
                                                $chg += $item->chg;
                                            }
                                        @endphp
                                        <tr>
                                            <td>
                                                <b>{{$value->user->fullName}}</b><br>
                                                <small>{{$value->user->email}}</small><br>
                                                <small>{{$value->user->number}}</small>
                                            </td>
                                            <td>{{number_format($value->amount,2)}}</td>
                                            <td>{{$value->qty}}</td>
                                            <td>{{number_format($value->amount + $pl,2)}}</td>
                                            <td>{{$chg >= 0 ? '+'.number_format($chg,2): number_format($chg,2)}}%</td>
                                            <td>{{$pl >= 0 ? '+'.number_format($pl,2): number_format($pl,2)}}</td>
                                            <td>
                                                @if($value->is_pms)
                                                    <p class="text-success">Start</p>
                                                @else
                                                    <p class="text-danger">Stop</p>
                                                @endif 
                                            </td>
                                            <td>{{Helper::date($value->created_at)}}</td>
                                            <td>
                                                {{ link_to(route('admin.plan.statementView', ['id' =>$value->id,'user_id'=>$value->id]),'<i class="fa fa-eye"></i>',['data-title'=>$value->user->fullName.'( '.$plan->title.' )','data-url'=>route('admin.plan.statementView', ['id' =>$value->id,'user_id'=>$value->id]),'class'=>'btn btn-default waves-effect  waves-float','data-toggle'=>'tooltip','data-original-title'=>__('View')],null, false)}}&nbsp;
                                            </td>
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
{!! $planChart->script() !!}
<script>
    $(".date").bootstrapMaterialDatePicker({weekStart:0,time:!1,maxDate:new Date}).on("change",function(e,t){$(this).focus(),$(this).next().removeClass("date_feild_close").addClass("date_feild_close_show")});
    $(document).on("click",".date_feild_close_show",function(){$(this).prev().val(""),$(this).removeClass("date_feild_close_show").addClass("date_feild_close")});
    $(document).on("change",".status_click",function(t){t.preventDefault();var c=$(this).data("url"),e=$(this).prop("checked");console.log($(this).prop("checked")),$.ajax({url:c,data:{status:e},type:"get",success:function(t){}})});
</script>
     
@stop