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
                        <li class="nav-item"><a href="{{route('admin.subscription.userSubscription',['id' => Helper::encode($user->id)])}}" class="nav-link">{{__('Subscription')}}</a></li>
                        <!-- <li class="nav-item"><a href="{{route('admin.statement.userStatement',['id' => Helper::encode($user->id)])}}" class="nav-link">{{__('Statement')}}</a></li> -->
                        <li class="nav-item"><a href="{{route('admin.userWallet',['id' => Helper::encode($user->id)])}}" class="nav-link active">{{__('Wallet')}}</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="usersettings">
                        <div class="card">
                            <div class="body">
                            <div class="row">
                    <div class="col-lg-12">
                        <div class="p-2">
                            <table class="table table-hover">
                                <tbody>
                                    @foreach($result as $key => $value)
                                        <tr>
                                            <td style="width: 30%;"><b>{{$key}}</b></td>
                                        </tr>
                                        @foreach($value as $Ikey => $item)
                                            @if($item->type == 1)
                                                <tr class="Credit" style="background-color: #a0fea0a3;">
                                            @else
                                                <tr class="Credit" style="background-color: #f6c4c4;">
                                            @endif
                                                <td style="width: 30%;" class="pl-5">{{$item->amount}}</td>
                                                <td style="width: 30%;" class="pl-5">
                                                    {{$item->remark}}<br>
                                                    <small>{{$item->created_at}}</small>
                                                </td>
                                                <td style="width: 30%;" class="pl-5">{{$item->closing_bal}}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    
                                        
                                </tbody>
                            </table>
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