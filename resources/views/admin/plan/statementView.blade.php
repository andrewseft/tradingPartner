
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
    @php
        $data = Helper::__statement($value->user_id,$value->plan_id);
        $pl = 0;
        $chg = 0;
        $sellAvg = 0;
        $sellAvgCount = 0;
        $commission = 0;
        $realised_profit = 0;
        $currentDate = "";
        foreach($data as $item){
            $pl += $item->pl;
            $chg += $item->chg;
            $sellAvg += $item->sell_avg;
            $sellAvgCount += 1;
            $commission += $item->commission;
            $realised_profit += $item->realised_profit;
            $currentDate = $item->created_at->format('Y-m-d h:i:s'); 
        }
    @endphp
    <div class="container-fluid">
    <div class="row clearfix">
        <div class="col-lg-12 pb-3">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-2">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td style="width: 30%;">Plan</td>
                                        <td>{{$value->plan->title}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Type</td>
                                        <td>{{Constant::PLAN_TYPE[$value->plan->type]}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Qty</td>
                                        <td>{{$value->qty}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Buy Avg</td>
                                        <td>{{$value->plan->amount}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Sell Avg</td>
                                        
                                        @if($sellAvg != 0)
                                            <td>{{number_format($sellAvg/$sellAvgCount,2)}}</td>
                                        @else
                                            <td>{{number_format(0,2)}}</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Investment</td>
                                        <td>
                                            <p class="text-success">{{number_format($value->amount,2)}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Current Value</td>
                                        <td>{{number_format($value->amount + $pl,2)}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Profit & Loss</td>
                                        <td>{{number_format($pl,2)}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">% Chg</td>
                                        <td>{{number_format($chg,2)}}%</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Plan Start Date</td>
                                        <td>{{$value->created_at}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Current Date</td>
                                        <td>{{$currentDate}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Charges (-5%)</td>
                                        <td>{{number_format($commission,2)}}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30%;">Realised Profit</td>
                                        <td><b>{{number_format($realised_profit,2)}}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card product_item_list">
                <div class="body table-responsive">
                    @if($data->count())
                    <h3>View Details</h3>
                    <div class="col py-1">{{ link_to( route('admin.redeem.excel',['user_id'=>$value->user_id,'type'=>0,'plan_id'=>$value->plan_id]),'Download as .xls',['class'=>'btn btn-success'],null, false)}}</div>
                        <table class="table table-hover m-b-0 table-striped">
                            <thead>
                                <tr>
                                    <th>Plan</th>
                                    <th>Type</th>
                                    <th>Buy Avg</th>
                                    <th>Sell Avg</th>
                                    <th>Amount Chg</th>
                                    <th>% Chg</th>
                                    <th>Qty</th>
                                    <th>Profit/Loss</th>
                                    <th>Invested</th>
                                    <th>Current Value</th>
                                    <th>P&L Balance</th>
                                    <th>Capital Balance</th>
                                    <th>Commission (-5%)</th>
                                    <th>Platform Fee</th>
                                    <th>Total Commission (Inc Taxes)</th>
                                    <th>Realised Profit</th>
                                    <th>Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($data->count())
                                    @foreach($data as $key => $item)
                                        <tr>
                                            <td>{{$value->plan->title}}</td>
                                            <td>{{Constant::PLAN_TYPE[$value->plan->type]}}</td>
                                            <td>{{$value->plan->amount}}</td>
                                            <td>{{number_format($item->sell_avg,2)}}</td>
                                            <td>
                                                @if($item->amount_chg >=0)
                                                    <p class="text-success">{{number_format($item->amount_chg,2)}}</p>
                                                @else
                                                    <p class="text-danger">{{number_format($item->amount_chg,2)}}</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->chg >=0)
                                                    <p class="text-success">{{number_format($item->chg,2)}}%</p>
                                                @else
                                                    <p class="text-danger">{{number_format($item->chg,2)}}%</p>
                                                @endif
                                            </td>
                                            <td>{{$item->qty}}</td>
                                            <td>
                                                @if($item->	pl >=0)
                                                    <p class="text-success">{{number_format($item->	pl,2)}}</p>
                                                @else
                                                    <p class="text-danger">{{number_format($item->	pl,2)}}</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->invested >=0)
                                                    <p class="text-success">{{number_format($item->invested,2)}}</p>
                                                @else
                                                    <p class="text-danger">{{number_format($item->invested,2)}}</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->	current_value >=0)
                                                    <p class="text-success">{{number_format($item->	current_value,2)}}</p>
                                                @else
                                                    <p class="text-danger">{{number_format($item->	current_value,2)}}</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->PL_balance >=0)
                                                    <p class="text-success">{{number_format($item->PL_balance,2)}}</p>
                                                @else
                                                    <p class="text-danger">{{number_format($item->PL_balance,2)}}</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->capital_balance >=0)
                                                    <p class="text-success">{{number_format($item->capital_balance,2)}}</p>
                                                @else
                                                    <p class="text-danger">{{number_format($item->capital_balance,2)}}</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->commission >=0)
                                                    <p class="text-success">{{number_format($item->commission,2)}}</p>
                                                @else
                                                    <p class="text-danger">{{number_format($item->commission,2)}}</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->platform_fee >=0)
                                                    <p class="text-success">{{number_format($item->platform_fee,2)}}</p>
                                                @else
                                                    <p class="text-danger">{{number_format($item->platform_fee,2)}}</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->total_commission >=0)
                                                    <p class="text-success">{{number_format($item->total_commission,2)}}</p>
                                                @else
                                                    <p class="text-danger">{{number_format($item->total_commission,2)}}</p>
                                                @endif
                                            </td>
                                            <td>
                                                @if($item->realised_profit >=0)
                                                    <p class="text-success">{{number_format($item->realised_profit,2)}}</p>
                                                @else
                                                    <p class="text-danger">{{number_format($item->realised_profit,2)}}</p>
                                                @endif
                                            </td>
                                            <td>{{$item->created_at}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
 
@stop
