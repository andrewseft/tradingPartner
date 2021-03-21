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
                        <li class="nav-item"><a href="{{route('admin.customer.view',['id' => Helper::encode($user->id)])}}" class="nav-link active">{{__('Profile')}}</a></li>
                        <li class="nav-item"><a href="{{route('admin.order.userOrder',['id' => Helper::encode($user->id)])}}" class="nav-link">{{__('Order')}}</a></li>
                        <li class="nav-item"><a href="{{route('admin.subscription.userSubscription',['id' => Helper::encode($user->id)])}}" class="nav-link">{{__('Subscription')}}</a></li>
                        <!-- <li class="nav-item"><a href="{{route('admin.statement.userStatement',['id' => Helper::encode($user->id)])}}" class="nav-link">{{__('User Statement')}}</a></li> -->
                        <li class="nav-item"><a href="{{route('admin.userWallet',['id' => Helper::encode($user->id)])}}" class="nav-link">{{__('Wallet')}}</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="usersettings">
                        <div class="card">
                            <div class="body">
                            <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td style="width: 30%;">KYC</td>
                                            <td>
                                                @if($user->is_kyc == 1)
                                                    <span class="text-success">Approved</span>
                                                @elseif($user->is_kyc == 2)
                                                    <span class="text-danger">Rejected</<span>
                                                @else
                                                    <span class="text-danger">Pending</<span>
                                                @endif
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Name</td>
                                            <td>{{Helper::mb_strtolower($user->first_name)}}</td>
                                        </tr>
                                        <!-- <tr>
                                            <td style="width: 30%;">Last Name</td>
                                            <td>{{Helper::mb_strtolower($user->last_name)}}</td>
                                        </tr> -->
                                        <tr>
                                            <td style="width: 30%;">Email</td>
                                            <td>{{$user->email}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Number</td>
                                            <td>{{$user->number ?? 'N/A'}}</td>
                                        </tr>
                                         
                                        <tr>
                                            <td style="width: 30%;">{{'Investment Capital'}}</td>
                                            @if(isset($investmentCapital[$user->investmentCapital]))
                                                <td>{{$investmentCapital[$user->investmentCapital]}}K</td>
                                            @else   
                                                <td>N/A</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Address</td>
                                            <td>{{$user->address ?? 'N/A'}}</td>
                                        </tr>

                                        <tr>
                                            <td style="width: 30%;">Adahr card number</td>
                                            <td>{{$user->profile->adahr_card_number ?? 'N/A'}}</td>
                                        </tr>

                                        <tr>
                                            <td style="width: 30%;">Pan cart number</td>
                                            <td>{{$user->profile->pan_cart_number  ?? 'N/A'}}</td>
                                        </tr>

                                        <tr>
                                            <td style="width: 30%;">Bank name</td>
                                            <td>{{$user->profile->bank_name  ?? 'N/A'}}</td>
                                        </tr>

                                        <tr>
                                            <td style="width: 30%;">Account number</td>
                                            <td>{{$user->profile->account_number  ?? 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Ifsc code</td>
                                            <td>{{$user->profile->ifsc_code  ?? 'N/A'}}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Adahr Card Image</td>
                                            @if(isset($user->profile->adahr_card_image ))
                                                <td>{!! Html::image(Helper::getImageUrl(Constant::DOC_IMAGE_THUMB.$user->profile->adahr_card_image),'user',['class'=>'rounded-circle'])  !!}</td>
                                            @else
                                                <td>N/A</td>
                                            @endif
                                             
                                        </tr>
                                        <tr>
                                            <td style="width: 30%;">Pan Cart Image</td>
                                            @if(isset($user->profile->pan_cart_image ))
                                                <td>{!! Html::image(Helper::getImageUrl(Constant::DOC_IMAGE_THUMB.$user->profile->pan_cart_image),'user',['class'=>'rounded-circle'])  !!}</td>
                                            @else
                                                <td>N/A</td>
                                            @endif
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
    <script>
        function openFileOption(e){document.getElementById(e).click()}$("#store_logo").change(function(e){document.getElementById("store_logo_view").src=URL.createObjectURL(e.target.files[0])});
    </script>
@stop