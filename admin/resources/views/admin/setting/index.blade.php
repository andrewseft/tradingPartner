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
        <div class="col-lg-12 col-md-12">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="usersettings">
                    <div class="card">
                        <div class="body">
                            {{ Form::model($data, ['url' => route('admin.setting.update'),'class' => 'user','files' => 'yes']) }}
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            {!! Html::decode(Form::label('Site Name',__('Site Name').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::text('name',null , array_merge(['class' => $errors->has('name') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required','data-validation-error-msg'=>__('This is a required field'),'data-validation-error-msg-container'=>'#site_name_error'])) }}
                                            <div class="invalid-feedback d-flex" id="site_name_error"></div>
                                            @error('name')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            {!! Html::decode(Form::label('Email',__('Email').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::email('email',null , array_merge(['class' => $errors->has('email') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,email','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#email_error','data-validation-error-msg-email'=>__('You have not given a correct e-mail address')])) }}
                                            <div class="invalid-feedback d-flex" id="email_error"></div>
                                            @error('email')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            {!! Html::decode(Form::label('support_email',__('Support Email').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::email('support_email',null , array_merge(['class' => $errors->has('support_email') ? 'form-control form-control-user has-error': 'form-control form-control-user','data-validation'=>'required,email','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#support_email_error','data-validation-error-msg-email'=>__('You have not given a correct e-mail address')])) }}
                                            <div class="invalid-feedback d-flex" id="support_email_error"></div>
                                            @error('support_email')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            {!! Html::decode(Form::label('number',__('Support Number').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::tel('number',null , array_merge(['class' => $errors->has('number') ? 'form-control form-control-user has-error allownumericwithdecimal': 'form-control form-control-user allownumericwithdecimal','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#number_error'])) }}
                                            <div class="invalid-feedback d-flex" id="number_error"></div>
                                            @error('number')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            {!! Html::decode(Form::label('Address',__('Address').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::textarea('address',null , array_merge(['size'=>'20x3','class' => $errors->has('address') ? 'form-control form-control-user has-error ': 'form-control form-control-user ','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#address_error'])) }}
                                            <div class="invalid-feedback d-flex" id="address_error"></div>
                                            @error('address')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            {!! Html::decode(Form::label('Copyright',__('Copyright').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::textarea('copy_right',null , array_merge(['size'=>'20x3','class' => $errors->has('copy_right') ? 'form-control form-control-user has-error ': 'form-control form-control-user ','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#copy_right_error'])) }}
                                            <div class="invalid-feedback d-flex" id="copy_right_error"></div>
                                            @error('copy_right')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            {!! Html::decode(Form::label('about_us',__('About Us for footer').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::textarea('about_us',null , array_merge(['size'=>'20x3','class' => $errors->has('about_us') ? 'form-control form-control-user has-error ': 'form-control form-control-user ','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#about_us_error'])) }}
                                            <div class="invalid-feedback d-flex" id="about_us_error"></div>
                                            @error('about_us')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            {!! Html::decode(Form::label('google_link',__('Play store link').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::textarea('google_link',null , array_merge(['size'=>'20x3','class' => $errors->has('google_link') ? 'form-control form-control-user has-error ': 'form-control form-control-user ','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#google_link_error'])) }}
                                            <div class="invalid-feedback d-flex" id="google_link_error"></div>
                                            @error('google_link')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            {!! Html::decode(Form::label('apple_link',__('App store link').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::textarea('apple_link',null , array_merge(['size'=>'20x3','class' => $errors->has('apple_link') ? 'form-control form-control-user has-error ': 'form-control form-control-user ','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#apple_link_error'])) }}
                                            <div class="invalid-feedback d-flex" id="apple_link_error"></div>
                                            @error('apple_link')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                    <div class="col-lg-6 col-md-6">

                                        <div class="form-group">
                                            {!! Html::decode(Form::label('planform_fee',__('Platform fee').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::text('planform_fee',null , array_merge(['class' => $errors->has('planform_fee') ? 'form-control form-control-user has-error allownumericwithdecimal': 'form-control form-control-user allownumericwithdecimal','data-validation'=>'required,number','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#planform_fee_error','data-validation-allowing'=>'range[0.00;100.00],float','autofocus'=>'true'])) }}
                                            <div class="invalid-feedback d-flex" id="planform_fee_error"></div>
                                            @error('planform_fee')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            {!! Html::decode(Form::label('commission',__('Referral Commission %').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::text('platform_commission',null , array_merge(['class' => $errors->has('platform_commission') ? 'form-control form-control-user has-error allownumericwithdecimal': 'form-control form-control-user allownumericwithdecimal','data-validation'=>'required,number','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#platform_commission_error','data-validation-allowing'=>'range[0.00;100.00],float','autofocus'=>'true'])) }}
                                            <div class="invalid-feedback d-flex" id="platform_commission_error"></div>
                                            @error('platform_commission')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            {!! Html::decode(Form::label('commission',__('Commission(%)').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::text('commission',null , array_merge(['class' => $errors->has('commission') ? 'form-control form-control-user has-error allownumericwithdecimal': 'form-control form-control-user allownumericwithdecimal','data-validation'=>'required,number','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#commission_error','data-validation-allowing'=>'range[0.00;100.00],float','autofocus'=>'true'])) }}
                                            <div class="invalid-feedback d-flex" id="commission_error"></div>
                                            @error('commission')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            {!! Html::decode(Form::label('sebi',__('Sebi(%)').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::text('sebi',null , array_merge(['class' => $errors->has('sebi') ? 'form-control form-control-user has-error allownumericwithdecimal': 'form-control form-control-user allownumericwithdecimal','data-validation'=>'required,number','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#sebi_error','data-validation-allowing'=>'range[0.00;100.00],float','autofocus'=>'true'])) }}
                                            <div class="invalid-feedback d-flex" id="sebi_error"></div>
                                            @error('sebi')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            {!! Html::decode(Form::label('sgst',__('Sgst(%)').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::text('sgst',null , array_merge(['class' => $errors->has('sgst') ? 'form-control form-control-user has-error allownumericwithdecimal': 'form-control form-control-user allownumericwithdecimal','data-validation'=>'required,number','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#sgst_error','data-validation-allowing'=>'range[0.00;100.00],float,float','autofocus'=>'true'])) }}
                                            <div class="invalid-feedback d-flex" id="sgst_error"></div>
                                            @error('sgst')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            {!! Html::decode(Form::label('stamp_duty',__('Stamp Duty(%)').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::text('stamp_duty',null , array_merge(['class' => $errors->has('stamp_duty') ? 'form-control form-control-user has-error allownumericwithdecimal': 'form-control form-control-user allownumericwithdecimal','data-validation'=>'required,number','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#stamp_duty_error','data-validation-allowing'=>'range[0.00;100.00],float','autofocus'=>'true'])) }}
                                            <div class="invalid-feedback d-flex" id="stamp_duty_error"></div>
                                            @error('stamp_duty')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            {!! Html::decode(Form::label('stt',__('Stt(%)').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::text('stt',null , array_merge(['class' => $errors->has('stt') ? 'form-control form-control-user has-error allownumericwithdecimal': 'form-control form-control-user allownumericwithdecimal','data-validation'=>'required,number','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#stt_error','data-validation-allowing'=>'range[0.00;100.00],float','autofocus'=>'true'])) }}
                                            <div class="invalid-feedback d-flex" id="stt_error"></div>
                                            @error('stt')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            {!! Html::decode(Form::label('igst',__('Igst(%)').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::text('igst',null , array_merge(['class' => $errors->has('igst') ? 'form-control form-control-user has-error allownumericwithdecimal': 'form-control form-control-user allownumericwithdecimal','data-validation'=>'required,number','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#igst_error','data-validation-allowing'=>'range[0.00;100.00],float','autofocus'=>'true'])) }}
                                            <div class="invalid-feedback d-flex" id="igst_error"></div>
                                            @error('igst')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            {!! Html::decode(Form::label('cgst',__('Cgst(%)').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::text('cgst',null , array_merge(['class' => $errors->has('cgst') ? 'form-control form-control-user has-error allownumericwithdecimal': 'form-control form-control-user allownumericwithdecimal','data-validation'=>'required,number','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#cgst_error','data-validation-allowing'=>'range[0.00;100.00],float','autofocus'=>'true'])) }}
                                            <div class="invalid-feedback d-flex" id="cgst_error"></div>
                                            @error('cgst')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            {!! Html::decode(Form::label('exchange_transaction_tax',__('Exchange Transaction Tax(%)').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::text('exchange_transaction_tax',null , array_merge(['class' => $errors->has('exchange_transaction_tax') ? 'form-control form-control-user has-error allownumericwithdecimal': 'form-control form-control-user allownumericwithdecimal','data-validation'=>'required,number','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#exchange_transaction_tax_error','data-validation-allowing'=>'range[0.00;100.00],float','autofocus'=>'true'])) }}
                                            <div class="invalid-feedback d-flex" id="exchange_transaction_tax_error"></div>
                                            @error('exchange_transaction_tax')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            {!! Html::decode(Form::label('wallet_charge',__('Wallet charges').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::text('wallet_charge',null , array_merge(['class' => $errors->has('wallet_charge') ? 'form-control form-control-user has-error allownumericwithdecimal': 'form-control form-control-user allownumericwithdecimal','data-validation'=>'required,number','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#wallet_charge_error','data-validation-allowing'=>'range[0.00;100.00],float','autofocus'=>'true'])) }}
                                            <div class="invalid-feedback d-flex" id="wallet_charge_error"></div>
                                            @error('wallet_charge')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                                                                
                    
                                        <div class="form-group">
                                            {!! Html::decode(Form::label('admin_limit',__('Admin Page Limit').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::tel('admin_limit',null , array_merge(['class' => $errors->has('admin_limit') ? 'form-control form-control-user has-error allownumericwithdecimal': 'form-control form-control-user allownumericwithdecimal','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#admin_limit_error'])) }}
                                            <div class="invalid-feedback d-flex" id="admin_limit_error"></div>
                                            @error('admin_limit')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            {!! Html::decode(Form::label('front_limit',__('Front Page Limit').'<span class="text-danger">*</span>',['class'=>''])) !!}
                                            {{ Form::tel('front_limit',null , array_merge(['class' => $errors->has('front_limit') ? 'form-control form-control-user has-error allownumericwithdecimal': 'form-control form-control-user allownumericwithdecimal','data-validation'=>'required','data-validation-error-msg-required'=>__('This is a required field'),'data-validation-error-msg-container'=>'#front_limit_error'])) }}
                                            <div class="invalid-feedback d-flex" id="front_limit_error"></div>
                                            @error('front_limit')
                                                <span class="invalid-feedback d-flex has-error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                </div>
                                {{ Form::button(__('Update'),['class'=>'btn btn-primary','id'=>'submitButton','type'=>'submit']) }}
                                <a href="{{route('admin.dashboard')}}" class="btn btn-light ml-3">{{__('Back')}}</a>
                            {{ Form::close() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@stop