@extends('layouts.admin')
@section('content')
@php
    $userData['id']=$user->id;
@endphp
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
                                {!! Html::image(Helper::getImageUrl(Constant::USER_IMAGE_THUMB.$user->image),'user',['class'=>'rounded-circle','id'=>'store_logo_view','width'=>'100px'])  !!}
                            @else
                                {!! Html::image('img/user.png','user',['class'=>'rounded-circle','id'=>'store_logo_view','width'=>'100px'])  !!}
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
                        <li class="nav-item"><a href="{{route('admin.profile')}}" class="nav-link">{{__('Profile')}}</a></li>
                        <li class="nav-item"><a href="{{route('admin.changePassword')}}" class="nav-link active">{{__('Change Password')}}</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="usersettings">
                        <div class="card">
                            <div class="body">
                                {{ Form::model($user, ['url' => route('admin.changePassword'),'class' => 'user','files' => 'yes']) }}
                                    {!! Form::hidden($user->image, $user->image, ['id' => 'hidden', 'name' => 'old_image', 'class' => 'text text-hidden']) !!}
                                    {!! Form::hidden($user->id, $user->id, ['id' => 'hidden', 'name' => 'id', 'class' => 'text text-hidden']) !!}
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            {!! Html::decode(Form::label('Current Password',__('Current Password').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            <div class="input-group">
                                                {{Form::password('current_password', ['id'=>'current_password','class' =>$errors->has('current_password') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,length,server','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#current_password_error','data-validation-length'=>'6-15','data-validation-url'=>route('checkEmail'),'data-validation-req-params'=>json_encode($userData),'data-validation-param-name'=>'current_password','autofocus'=>'true'])}}
                                                <div class="input-group-append">
                                                    <span class="input-group-text" class="password_view_icon" onclick="showHidePwd('current_password','eye');"><span toggle="#password-field" id="eye" class="fa fa-eye-slash field-icon toggle-password"></span></span>
                                                </div>
                                                <div class="invalid-feedback d-flex" id="current_password_error"></div>
                                                @error('current_password')
                                                    <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="form-group col-md-12">
                                            {!! Html::decode(Form::label('Password',__('Password').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            <div class="input-group">
                                                {{Form::password('password', ['id'=>'password','class' =>$errors->has('password') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,custom,length','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#password_error','data-validation-length'=>'6-50','data-validation-regexp'=>'^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$','data-validation-error-msg-custom'=>__('PASSWORD_REGEXP'),'autofocus'=>'true'])}}
                                                <div class="input-group-append">
                                                    <span class="input-group-text" class="password_view_icon" onclick="showHidePwd('password','eye_1');"><span toggle="#password-field" id="eye_1" class="fa fa-eye-slash field-icon toggle-password"></span></span>
                                                </div>
                                                <div class="invalid-feedback d-flex" id="password_error"></div>
                                                @error('password')
                                                    <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            {!! Html::decode(Form::label('Password',__('Confirm Password').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            <div class="input-group">
                                                {{Form::password('password_confirmation', ['id'=>'password_confirmation','class' =>$errors->has('password_confirmation') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,length,confirmation','data-validation-confirm'=>'password','data-validation-error-msg-confirmation'=>__('Password and confirm password does not matched'),'data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#password_confirmation_error','data-validation-length'=>'6-50','autofocus'=>'true'])}}
                                                <div class="input-group-append">
                                                    <span class="input-group-text" class="password_view_icon" onclick="showHidePwd('password_confirmation','eye_2');"><span toggle="#password-field" id="eye_2" class="fa fa-eye-slash field-icon toggle-password"></span></span>
                                                </div>
                                                <div class="invalid-feedback d-flex d-flex" id="password_confirmation_error"></div>
                                                @error('password_confirmation')
                                                    <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                                @enderror
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
        function showHidePwd(text_id,id) {
            var input = document.getElementById(text_id);
            if (input.type === "password") {
                input.type = "text";
                document.getElementById(id).className = "fa fa-eye";
            } else {
                input.type = "password";
                document.getElementById(id).className = "fa fa-eye-slash";
            }
        }
    </script>
@stop