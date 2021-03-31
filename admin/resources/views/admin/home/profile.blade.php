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
                            <small class="text-muted">{{__('Email address')}}</small>
                            <h6>{{$user->email}}</h6>
                            <small class="text-muted">{{__('Login Time')}}</small>
                            <h6>{{$user->last_login_at}}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a href="{{route('admin.profile')}}" class="nav-link active">{{__('Profile')}}</a></li>
                        <li class="nav-item"><a href="{{route('admin.changePassword')}}" class="nav-link">{{__('Change Password')}}</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="usersettings">
                        <div class="card">
                            <div class="body">
                                {{ Form::model($user, ['url' => route('admin.profile'),'class' => 'user','files' => 'yes']) }}
                                    {!! Form::hidden($user->image, $user->image, ['id' => 'hidden', 'name' => 'old_image', 'class' => 'text text-hidden']) !!}
                                    {!! Form::hidden($user->id, $user->id, ['id' => 'hidden', 'name' => 'id', 'class' => 'text text-hidden']) !!}
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            {!! Html::decode(Form::label('first_name',__('First Name').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::text('first_name',null , array_merge(['class' => $errors->has('first_name') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,length','data-validation-error-msg'=>__('This is a required field'),'data-validation-error-msg-container'=>'#first_name_error','data-validation-length'=>'1-50','autofocus'=>'true'])) }}
                                            <div class="invalid-feedback d-flex" id="first_name_error"></div>
                                            @error('first_name')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            {!! Html::decode(Form::label('Last Name',__('Last Name').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::text('last_name',null , array_merge(['class' => $errors->has('last_name') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,length','data-validation-error-msg'=>__('This is a required field'),'data-validation-error-msg-container'=>'#last_name_error','data-validation-length'=>'1-50','autofocus'=>'true'])) }}
                                            <div class="invalid-feedback d-flex" id="last_name_error"></div>
                                            @error('last_name')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            {!! Html::decode(Form::label('email',__('Email Address').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::email('email',null , array_merge(['class' => $errors->has('email') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,length','data-validation-url'=>route('checkEmail'),'data-validation-req-params'=>json_encode($user),'data-validation-param-name'=>'email','data-validation-error-msg'=>__('This is a required field'),'data-validation-error-msg-container'=>'#email-error','data-validation-length'=>'1-50','autofocus'=>'true'])) }}
                                            <div class="invalid-feedback d-flex" id="email-error"></div>
                                            @error('email')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            {!! Html::decode(Form::label('Profile Image',__('Profile Image (Max 1Mb & Dimension 200x200-1000x1000)'),['class'=>''])) !!}
                                            <div class="member-img store-logo">
                                                <div class="edit_profile_sec">
                                                    <a href="javascript:viod(#);" class="" onclick="openFileOption('store_logo');return;">
                                                        @if(Helper::exists(Constant::USER_IMAGE_THUMB.$user->image) && $user->image != NULL)
                                                            {!! Html::image(Helper::getImageUrl(Constant::USER_IMAGE_THUMB.$user->image),'user',['class'=>'rounded-circle','id'=>'store_logo_view','width'=>'100px'])  !!}
                                                        @else
                                                            {!! Html::image('img/user.png','user',['class'=>'rounded-circle','id'=>'store_logo_view','width'=>'100px'])  !!}
                                                        @endif
                                                    </a>
                                                    <div class="change_profile_pic">{{ Form::file('image', ['id' => 'store_logo', 'name' => 'image', 'class' => 'file','accept'=>'image/*',' data-validation'=>'mime,dimension,size','data-validation-max-size'=>'1024kb','data-validation-error-msg-size'=>'You can not upload images larger than 1024kb','data-validation-error-msg-container'=>'#logo-error','data-validation-allowing'=>'jpg, png','data-validation-dimension'=>'200x200-1000x1000']) }}<i class="fas fa-camera"></i></div>
                                                </div>



                                                @error('image')
                                                    <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                                @enderror
                                                <div class="invalid-feedback d-flex" id="logo-error"></div>
                                                <span >{{$user->seller_id}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-5">
                                        {{ Form::button(__('Update'),['class'=>'btn btn-primary float-left','id'=>'submitButton','type'=>'submit']) }}
                                        <a href="{{route('admin.dashboard')}}" class='btn btn-light float-left ml-3'>{{__('Back')}}</a>
                                    </div>
                                {{ Form::close() }}
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