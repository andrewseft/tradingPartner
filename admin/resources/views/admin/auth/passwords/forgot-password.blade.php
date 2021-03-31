@extends('layouts.admin_login')
@section('content')
    {{ Form::model($user, ['url' =>route('admin.forgotPassword'),'class' => 'form admin_form']) }}
        <div class="header">
            <div class="logo-container">
                {!! Html::image('img/logo.png',null,['width'=>'120px','class'=>"login_logo"]) !!}
            </div>
            <div class="text-center">
                <h5 class="mb-3">Forgot Password!</h5>
                <p>{{__("We get it, stuff happens. Just enter your email below and we'll send you a link to reset your password!")}}</p>
            </div>
        </div>
        <div class="content">
            <div class="input-group input-lg">
            {{ Form::email('email',null , array_merge(['placeholder'=>__('Email*'),'class' => $errors->has('email') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,server','data-validation-url'=>route('checkEmailExists'),'data-validation-param-name'=>'email','data-validation-error-msg'=>__('This is a required field'),'data-validation-error-msg-container'=>'#email-error','autofocus'=>'true'])) }}
                <span class="input-group-addon">
                    <i class="zmdi zmdi-email"></i>
                </span>
                @error('email')
                    <span class="invalid-feedback has-error d-flex">{{ $message }}</span>
                @enderror
                <div class="invalid-feedback d-flex" id="email-error"></div>
            </div>
        </div>
        <div class="footer text-center pb-5">
            {{ Form::button(__('Send Login Link'),['class'=>'btn l-cyan btn-round btn-lg btn-block waves-effect waves-light','id'=>'submitButton','type'=>'submit']) }}
            <h6 class="m-t-20">
                {!! Html::decode(link_to_route('admin.login',__('Already have an account? Login!'),null,['class'=>'link'],false))!!}
            </h6>
        </div>
    {{ Form::close() }}
@stop