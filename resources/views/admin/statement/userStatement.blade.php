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
                        <li class="nav-item"><a href="{{route('admin.subscription.userSubscription',['id' => Helper::encode($user->id)])}}" class="nav-link ">{{__('Subscription')}}</a></li>
                        <li class="nav-item"><a href="{{route('admin.statement.userStatement',['id' => Helper::encode($user->id)])}}" class="nav-link active">{{__('Statement')}}</a></li>
                        <li class="nav-item"><a href="{{route('admin.userWallet',['id' => Helper::encode($user->id)])}}" class="nav-link">{{__('Wallet')}}</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="usersettings">
                        <div class="card">
                            <div class="body">
                                 
                            <div class="container-fluid">
                                @if($data->count() || $request->query('keyword') || $request->query('email')|| $request->query('investmentCapital') || $request->query('created_at_from') || $request->query('created_at_to') || $request->query('status') || $request->query('plan') || $request->query('is_kyc'))
                                    <div class="row no-gutters">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="card">
                                                <div class="body">
                                                {{ Form::model($userData, ['url' => route('admin.statement.userStatement',['id' => Helper::encode($user->id)]),'class' => 'search_form','method'=>'get']) }}
                                                    <div class="row table_search_form align-items-center">
                                                         
                                                        <div class="col date_feild py-1">
                                                            {{ Form::text('created_at_from',null , array_merge(['id'=>'date','class' =>'form-control date','placeholder'=>__('From'),'readonly'=>true])) }}
                                                            <a href="javascript:void(0)" class="{{isset($userData['created_at_from']) ? 'date_feild_close_show': 'date_feild_close'}}"><i class="fas fa-times-circle"></i></a>
                                                        </div>
                                                        <div class="col date_feild py-1">
                                                            {{ Form::text('created_at_to',null , array_merge(['class' =>'form-control date','placeholder'=>__('To'),'readonly'=>true])) }}
                                                            <a href="javascript:void(0)" class="{{isset($userData['created_at_to']) ? 'date_feild_close_show': 'date_feild_close'}}"><i class="fas fa-times-circle"></i></a>
                                                        </div>
                                                        <div class="col py-1">{{ Form::button('<i class="fas fa-search"></i>',['class'=>'btn btn-secondary float-left','id'=>'submitButton','type'=>'submit']) }}</div>
                                                        <div class="col py-1">{{ link_to( route('admin.statement.userStatement',['id' => Helper::encode($user->id)]),'<i class="fas fa-redo-alt"></i>',['class'=>'btn btn-danger'],null, false)}}</div>
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
                                                                    
                                                                    <th>Plan</th>
                                                                    <th>Capital Balance</th>
                                                                    <th>Realised Profit</th>
                                                                    <th>PMS</th>
                                                                    <th width="15%">created At</th>
                                                                    <th>{{__('Action')}}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @include('admin.statement.list_user')
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