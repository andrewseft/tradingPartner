<div id="home" class="main-banner">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6 wow fadeInLeft" data-wow-delay=".3s">
                            <div class="banner-content">
                                <h1>Banknifty PMS Customized <br> Portfolio Management Service</h1>
                                <p>Create Legacy Wealth</p>
                                <div class="banner-holder">
                                    <a href="#">
                                        <img src="{{URL::to('img/1.png')}}" alt="image">
                                    </a>
                                    <a href="#">
                                        <img src="{{URL::to('img/2.png')}}" alt="image">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="banner-form">
                                <h3>Get started for Free</h3>
                                <p>App ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.</p>
                                {{ Form::model('contact', ['url' =>route('page.contact'),'class' => 'contact-form','files' => 'yes']) }}
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
                                    <div class="form-group">
                                        {{ Form::textarea('message_info',null , array_merge(['class' => $errors->has('message_info') ? ' form-control  has-error': ' form-control','placeholder'=>__('Enter Message'),'data-validation'=>'required','data-validation-error-msg'=>__('This field is required'),'data-validation-error-msg-container'=>'#message_error'])) }}
                                        <div id="message_error" class="invalid-feedback d-flex"></div>
                                    </div>
                                    {{ Form::button(__('Send Message'),['class'=>'default-btn','id'=>'submitButton','type'=>'submit']) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="default-shape">
            <div class="shape-1">
                <img src="{{URL::to('img/shape/1.png')}}" alt="image">
            </div>
            <div class="shape-2 rotateme">
                <img src="{{URL::to('img/shape/2.png')}}" alt="image">
            </div>
            <div class="shape-3">
                <img src="{{URL::to('img/shape/3.svg')}}" alt="image">
            </div>
            <div class="shape-4">
                <img src="{{URL::to('img/shape/4.svg')}}" alt="image">
            </div>
            <div class="shape-5">
                <img src="{{URL::to('img/shape/5.png')}}" alt="image">
            </div>
        </div>
    </div>