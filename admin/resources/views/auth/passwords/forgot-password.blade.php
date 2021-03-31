@extends('layouts.admin_login')
@section('content')
<h1 class="mb-2">{{__('Forgot Password')}}</h1>
<p>{{__("We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!")}}</p>
  {{ Form::model($user, ['url' =>route('admin.forgotPassword'),'class' => 'mt-3 mt-sm-5']) }}
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
        <div class="col-12 mt-3">
            {{ Form::submit(__('Send Login Link'),['class'=>'btn btn-primary text-uppercase']) }}
        </div>
        <div class="col-12">
            <div class="d-block d-sm-flex  align-items-center">
                {!! Html::decode(link_to_route('admin.login',__('Already have an account? Login!'),null,['class'=>'ml-auto'],false))!!}
            </div>
        </div>
    </div>
  {{ Form::close() }}
@stop