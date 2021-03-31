@extends('layouts.admin_login')
@section('content')
    {{ Form::model($passwordReset, ['url' =>route('admin.resetPassword',$passwordReset->token),'class' => 'form admin_form']) }}
        <div class="header">
            <div class="logo-container">
                {!! Html::image('img/logo.png',null,['width'=>'120px','class'=>"login_logo"]) !!}
            </div>
            <div class="text-center">
                <h5 class="mb-2">Create New Password</h5>
            </div>
        </div>
        <div class="content">
            <div class="input-group input-lg">
                {{ Form::hidden('email',null , array_merge(['placeholder'=>__('Email*'),'class' => $errors->has('email') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,server','data-validation-url'=>route('checkEmailExists'),'data-validation-param-name'=>'email','data-validation-error-msg'=>__('This is a required field'),'data-validation-error-msg-container'=>'#email-error','readonly'=>'true'])) }}
                <!--<span class="input-group-addon">
                    <i class="zmdi zmdi-account-circle"></i>
                </span>-->
                @error('email')
                    <span class="invalid-feedback has-error d-flex">{{ $message }}</span>
                @enderror
                <div class="invalid-feedback d-flex" id="email-error"></div>
            </div>
            <div class="input-group input-lg">
                {{Form::password('password', ['placeholder'=>__('Password*'),'id'=>'password','class' =>$errors->has('password') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,confirmation,custom,length','data-validation-confirm'=>'password','data-validation-error-msg-confirmation'=>__('Password and confirm password does not matched'),'data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#password-error','data-validation-length'=>'6-50','data-validation-regexp'=>'^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$','data-validation-error-msg-custom'=>__('PASSWORD_REGEXP'),'autofocus'=>'true'])}}
                <span class="input-group-addon">
                    <i class="zmdi zmdi-lock"></i>
                </span>
                <div class="invalid-feedback d-flex" id="password-error"></div>
            </div>

            <div class="input-group input-lg">
                {{Form::password('password_confirmation', ['placeholder'=>__('Confirm Password*'),'class' =>$errors->has('password_confirmation') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,length,confirmation','data-validation-error-msg-confirmation'=>__('Password and Confirm password does not matched'),'data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#password_confirmation_error','data-validation-length'=>'6-50','data-validation-confirm'=>'password'])}}
                <span class="input-group-addon">
                    <i class="zmdi zmdi-lock"></i>
                </span>
                <div class="invalid-feedback d-flex" id="password_confirmation_error"></div>
            </div>


        </div>
        <div class="footer text-center pb-5">
            {{ Form::button(__('Submit'),['class'=>'btn l-cyan btn-round btn-lg btn-block waves-effect waves-light','id'=>'submitButton','type'=>'submit']) }}
            <h6 class="m-t-20">
                {!! Html::decode(link_to_route('admin.login',__('Back To Login'),null,['class'=>'link'],false))!!}
            </h6>
        </div>
    {{ Form::close() }}
@stop