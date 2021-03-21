@extends('layouts.app_page')
@section('content')
    <!-- ***** Breadcrumb Area Start ***** -->
    <section class="section breadcrumb-area bg-overlay d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Breamcrumb Content -->
                    <div class="breadcrumb-content d-flex flex-column align-items-center text-center">
                        <h2 class="text-white text-capitalize">Customer Queries</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">{!! Html::decode(link_to_route('homePage',__('Home'),'#home',['class'=>"text-uppercase text-white"])) !!}</li>
                            <li class="breadcrumb-item text-white active">Customer Queries</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--====== Height Emulator Area Start ======-->
    <div class="height-emulator d-none d-lg-block"></div>
    <!--====== Height Emulator Area End ======-->

    <!--====== Contact Area Start ======-->
<section id="contact" class="contact-area bg-gray ptb_100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-6">
                <!-- Section Heading -->
                <div class="section-heading text-center">
                    <h2 class="text-capitalize">Queries</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-12 col-md-12 pt-4 pt-md-0">
                <!-- Contact Box -->
                <div class="contact-box text-center">
                    <!-- Contact Form -->
                    {{ Form::model('contact', ['url' =>route('page.contact'),'class' => 'contact-form','files' => 'yes']) }}
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    {{ Form::text('name',null , array_merge(['class' => $errors->has('name') ? 'form-control  has-error': 'form-control','placeholder'=>__('Name'),'data-validation'=>'required','data-validation-error-msg'=>__('This field is required'),'data-validation-error-msg-container'=>'#first_name_error'])) }}
                                    <div id="first_name_error" class="invalid-feedback d-flex"></div>
                                </div>
                                <div class="form-group">
                                    {{ Form::email('email',null , array_merge(['class' => $errors->has('email') ? 'form-control  has-error': 'form-control','placeholder'=>__('Email'),'data-validation'=>'email','data-validation-error-msg'=>__('This field is required'),'data-validation-error-msg-container'=>'#email-error'])) }}
                                    <div  id="email-error" class="invalid-feedback d-flex"></div>
                                </div>
                                <div class="form-group">
                                    {{ Form::text('subject',null , array_merge(['class' => $errors->has('subject') ? 'form-control  has-error': 'form-control','placeholder'=>__('Subject'),'data-validation'=>'required','data-validation-error-msg'=>__('This field is required'),'data-validation-error-msg-container'=>'#subject_error'])) }}
                                    <div id="subject_error" class="invalid-feedback d-flex"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    {{ Form::textarea('message_info',null , array_merge(['class' => $errors->has('message_info') ? ' form-control  has-error': ' form-control','placeholder'=>__('Enter Message'),'data-validation'=>'required','data-validation-error-msg'=>__('This field is required'),'data-validation-error-msg-container'=>'#message_error'])) }}
                                    <div id="message_error" class="invalid-feedback d-flex"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                {{ Form::button('<span class="text-white pr-3"><i class="fas fa-paper-plane"></i></span>'.__('Submit'),['class'=>'btn btn-lg btn-block mt-3','id'=>'submitButton','type'=>'submit']) }}
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</section>
<!--====== Contact Area End ======-->
@stop