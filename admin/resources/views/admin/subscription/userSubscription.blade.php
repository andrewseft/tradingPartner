@extends('layouts.admin')
@section('content')
<div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>{{$title}}</h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="zmdi zmdi-home"></i> {{__('Home')}}</a></li>
                    <li class="breadcrumb-item active">{{$title}}</li>
                </ul>
            </div>
        </div>
</div>
<div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-4 col-md-12">
                <div class="card member-card">
                    <div class="header l-cyan">
                        <h4 class="m-t-10">{{$user->fullName}}</h4>
                    </div>
                    <div class="member-img">
                        <a href="{{route('admin.dashboard')}}" class="">
                            @if(Helper::exists(Constant::USER_IMAGE_THUMB.$user->image) && $user->image != NULL)
                                {!! Html::image(Helper::getImageUrl(Constant::USER_IMAGE_THUMB.$user->image),'user',['class'=>'rounded-circle','id'=>'','width'=>'100px'])  !!}
                            @else
                                {!! Html::image('img/user.png','user',['class'=>'rounded-circle','id'=>'','width'=>'100px'])  !!}
                            @endif
                        </a>
                    </div>
                    <div class="body">
                        <div class="col-12">
                            <p class="text-muted">{{$user->email}}</p>
                        </div>
                        <hr>
                        <div class="card-body">
                            <small class="text-muted">{{__('Login Time')}}</small>
                            <h6>{{$user->last_login_at}}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a href="{{route('admin.customer.view',['id' => Helper::encode($user->id)])}}" class="nav-link">{{__('Profile')}}</a></li>
                        <li class="nav-item"><a href="{{route('admin.order.userOrder',['id' => Helper::encode($user->id)])}}" class="nav-link">{{__('Order')}}</a></li>
                        <li class="nav-item"><a href="{{route('admin.subscription.userSubscription',['id' => Helper::encode($user->id)])}}" class="nav-link active">{{__('Subscription')}}</a></li>
                        <!-- <li class="nav-item"><a href="{{route('admin.statement.userStatement',['id' => Helper::encode($user->id)])}}" class="nav-link">{{__('Statement')}}</a></li> -->
                        <li class="nav-item"><a href="{{route('admin.userWallet',['id' => Helper::encode($user->id)])}}" class="nav-link">{{__('Wallet')}}</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="usersettings">
                        <div class="card">
                            <div class="body">
                                <div class="container-fluid">
                                    <div class="row no-gutters">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="card">
                                                <ul class="row profile_state list-unstyled">
                                                    <li class="col-lg-4 col-md-4 col-4">
                                                        <div class="body">
                                                            <h4>{{number_format($totalInvested,2)}}</h4>
                                                            <span>Invested</span>
                                                        </div>
                                                    </li>
                                                    <li class="col-lg-4 col-md-4 col-4">
                                                        <div class="body">
                                                            <h4>{{$currentInvested > 0 ? '+'.number_format($currentInvested,2) :number_format($currentInvested,2)}}</h4>
                                                            <span>Current</span>
                                                        </div>
                                                    </li>
                                                    <li class="col-lg-4 col-md-4 col-4">
                                                        <div class="body">
                                                            <h4>{{$pl_amount > 0 ? '+'.number_format($pl_amount,2) :number_format($pl_amount,2)}}({{$pl_percentage > 0 ? '+'.round($pl_percentage,2).'%' :round($pl_percentage,2).'%'}})</h4>
                                                            <span>P&L</span>
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
                                                        {{ Form::model($subscriptionData, ['url' => route('admin.subscription.userSubscription',['id' => Helper::encode($user->id)]),'class' => 'search_form','method'=>'get']) }}
                                                            <div class="row table_search_form align-items-center">
                                                                
                                                                <div class="col date_feild py-1">
                                                                    {{ Form::text('created_at_from',null , array_merge(['id'=>'date','class' =>'form-control date','placeholder'=>__('From'),'readonly'=>true])) }}
                                                                    <a href="javascript:void(0)" class="{{isset($booking['created_at_from']) ? 'date_feild_close_show': 'date_feild_close'}}"><i class="fas fa-times-circle"></i></a>
                                                                </div>
                                                                <div class="col date_feild py-1">
                                                                    {{ Form::text('created_at_to',null , array_merge(['class' =>'form-control date','placeholder'=>__('To'),'readonly'=>true])) }}
                                                                    <a href="javascript:void(0)" class="{{isset($booking['created_at_to']) ? 'date_feild_close_show': 'date_feild_close'}}"><i class="fas fa-times-circle"></i></a>
                                                                </div>
                                                                <div class="col py-1">{{ Form::button('<i class="fas fa-search"></i>',['class'=>'btn btn-secondary float-left','id'=>'submitButton','type'=>'submit']) }}</div>
                                                                <div class="col py-1">{{ link_to( route('admin.subscription.userSubscription',['id' => Helper::encode($user->id)]),'<i class="fas fa-redo-alt"></i>',['class'=>'btn btn-danger'],null, false)}}</div>
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
                                                                    <th>@sortablelink('qty',__('Qty '))</th>
                                                                    <th>Total Invested</th>
                                                                    <th>Current Value</th>
                                                                    <th>%Chg</th>
                                                                    <th>P&L</th>
                                                                    <th>@sortablelink('created_at',__('created At '))</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if($data->count())
                                                                    @foreach($data as $key => $value)
                                                                        @php
                                                                            if($value->type == 1){
                                                                                $data = Helper::__statement($value->user_id,$value->plan_id);
                                                                            }else{
                                                                                $data = Helper::__statementStop($value->user_id,$value->plan_id);
                                                                            }
                                                                            
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
                                                                        <tr>
                                                                            <td>{{$value->plan->title}}</td>
                                                                            <td>  
                                                                                {{ link_to('#javascript:void(0)',$value->user->fullName,['data-title'=>$value->user->fullName,'data-url'=>route('admin.customer.view', ['id' => Helper::encode($value->user->id)]),'onclick'=>'return false;','class'=>'',],null, false)}}&nbsp;
                                                                            </td>
                                                                            <td> {{$value->qty}}</td>
                                                                            @if($value->type == 1)
                                                                                <td>{{number_format($value->amount,2)}}</td>
                                                                                <td>{{number_format($value->amount + $pl,2)}}</td>
                                                                            @else
                                                                                <td>{{number_format($value->amount*$value->qty,2)}}</td>
                                                                                <td>{{number_format(($value->amount*$value->qty) + $pl,2)}}</td>
                                                                            @endif
                                                                            <td>{{number_format($chg,2)}}%</td>
                                                                            <td>{{number_format($pl,2)}}</td>
                                                                            <td>{{Helper::date($value->created_at)}}</td>
                                                                            <td>
                                                                                @if($value->type == 1)
                                                                                    {{ link_to(route('admin.plan.statementView', ['id' =>$value->id,'user_id'=>$value->id]),'<i class="fa fa-eye"></i>',['data-url'=>route('admin.plan.statementView', ['id' =>$value->id,'user_id'=>$value->id]),'class'=>'btn btn-default waves-effect  waves-float','data-toggle'=>'tooltip','data-original-title'=>__('View')],null, false)}}&nbsp;
                                                                                @else
                                                                                    {{ link_to(route('admin.plan.statementViewStop', ['id' =>$value->id,'user_id'=>$value->id]),'<i class="fa fa-eye"></i>',['data-url'=>route('admin.plan.statementViewStop', ['id' =>$value->id,'user_id'=>$value->id]),'class'=>'btn btn-default waves-effect  waves-float','data-toggle'=>'tooltip','data-original-title'=>__('View')],null, false)}}&nbsp;
                                                                                @endif
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
                            </div>
                        </div>

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