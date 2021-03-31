@extends('layouts.admin_login')
@section('content')
@php
$remember_me = '';
if(!empty($user)){
  $remember_me = 'checked';
}
@endphp
    {{ Form::model($user, ['url' =>route('admin.login'),'class' => 'form admin_form']) }}
        {{ Form::hidden('device_token',null , array_merge(['id'=>'web_token'])) }}
        <div class="header">
            <div class="logo-container ">
                {!! Html::image('img/logo.png',null,['class'=>"login_logo"]) !!}
            </div>
            <div class="text-center">
                <h5 class="mb-2">Welcome Back!</h5>
                <p>{{__('Enter your email and password to access admin panel.')}}</p>
            </div>
        </div>
        <div class="content">
            <div class="input-group input-lg">
            {{ Form::email('email',null , array_merge(['placeholder'=>__('Email*'),'class' => $errors->has('email') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,server','data-validation-url'=>route('checkEmailExists'),'data-validation-param-name'=>'email','data-validation-error-msg'=>__('This is a required field'),'data-validation-error-msg-container'=>'#email-error','autofocus'=>'true'])) }}
                <span class="input-group-addon">
                    <i class="zmdi zmdi-email"></i>
                </span>
                <div class="invalid-feedback d-flex" id="email-error"></div>
            </div>
            <div class="input-group input-lg">
            {{Form::password('password', ['placeholder'=>__('Password*'),'id'=>'password','class' =>$errors->has('password') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,confirmation,custom,length','data-validation-confirm'=>'password','data-validation-error-msg-confirmation'=>__('Password and confirm password does not matched'),'data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#password-error','data-validation-length'=>'6-50','data-validation-regexp'=>'^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$','data-validation-error-msg-custom'=>__('PASSWORD_REGEXP'),'autofocus'=>'true'])}}
                <span class="input-group-addon">
                    <i class="zmdi zmdi-lock"></i>
                </span>
                <div class="invalid-feedback d-flex" id="password-error"></div>
            </div>
            <div class="d-block d-sm-flex  align-items-center">
                <div class="form-group">
                    <div class="checkbox">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember_me" {{ $remember_me }}>
                        <label for="remember">Remember Me</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer text-center pb-5">
            {{ Form::button(__('SIGN IN'),['class'=>'btn l-cyan btn-round btn-lg btn-block waves-effect waves-light','id'=>'submitButton','type'=>'submit']) }}
            <h6 class="m-t-20">
                {!! Html::decode(link_to_route('admin.forgotPassword',__('Forgot Password?'),null,['class'=>'link'],false))!!}
            </h6>
        </div>
    {{ Form::close() }}
@stop

