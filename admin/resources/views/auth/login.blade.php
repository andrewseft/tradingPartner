@extends('layouts.admin_login')
@section('content')
@php
$remember_me = '';
if(!empty($user)){
  $remember_me = 'checked';
}
@endphp
<h1 class="mb-2">Welcome Back!</h1>
<p>{{__('Enter your email address and password to access admin panel.')}}</p>
  {{ Form::model($user, ['url' =>route('admin.login'),'class' => 'mt-3 mt-sm-5']) }}
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                {!! Form::label('Email', 'Email*', array('class' => 'control-label')) !!}
                {{ Form::email('email',null , array_merge(['class' =>$errors->has('email') ? 'form-control form-control-user has-error': 'form-control form-control-user' ,'placeholder'=>__('Enter your email'),'data-validation'=>'email','data-validation-error-msg'=>__('This field is required'),'data-validation-error-msg-container'=>'#email-error'])) }}
                <div class="invalid-feedback" id="email-error"></div>
                @error('email')
                    <span class="invalid-feedback has-error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {!! Form::label('Password', 'Password*', array('class' => 'control-label')) !!}
                {{Form::password('password', ['class' => 'form-control form-control-user','placeholder'=>__('Enter your password'),'data-validation'=>'required','data-validation-error-msg'=>__('This field is required'),'data-validation-error-msg-container'=>'#password-error'])}}
                <div class="invalid-feedback" id="password-error"></div>
            </div>
        </div>
        <div class="col-12">
            <div class="d-block d-sm-flex  align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember_me" {{ $remember_me }}>
                    <label class="form-check-label" for="remember">
                        Remember Me
                    </label>
                </div>
                {!! Html::decode(link_to_route('admin.forgotPassword',__('Forgot Password?'),null,['class'=>'ml-auto'],false))!!}
            </div>
        </div>
        <div class="col-12 mt-3">
            {{ Form::submit(__('Sign In'),['class'=>'btn btn-primary text-uppercase']) }}
        </div>
    </div>
  {{ Form::close() }}
@stop