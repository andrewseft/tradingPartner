<section class="app-download ptb-100">
            <div class="container">
                <div class="app-download-content">
                    <h3>Download Our Apps Today</h3>
                    <div class="bar"></div>
                   
                    <div class="app-holder">
                        <a href="#">
                            <img src="{{URL::to('img/1.png')}}" alt="image">
                        </a>
                        <a href="#">
                            <img src="{{URL::to('img/2.png')}}" alt="image">
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section id="contact" class="contact-area ptb-100">
            <div class="container">
                <div class="section-title">
                    <h2>Contact Us</h2>
                    <div class="bar"></div>
                    
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="contact-form">
                        {{ Form::model('contact', ['url' =>route('page.contact'),'class' => 'contact-form','files' => 'yes']) }}
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            {{ Form::text('name',null , array_merge(['class' => $errors->has('name') ? 'form-control  has-error': 'form-control','placeholder'=>__('Name'),'data-validation'=>'required','data-validation-error-msg'=>__('This field is required'),'data-validation-error-msg-container'=>'#first_name_error'])) }}
                                            <div id="first_name_error" class="invalid-feedback d-flex"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            {{ Form::email('email',null , array_merge(['class' => $errors->has('email') ? 'form-control  has-error': 'form-control','placeholder'=>__('Email'),'data-validation'=>'email','data-validation-error-msg'=>__('This field is required'),'data-validation-error-msg-container'=>'#email-error'])) }}
                                            <div  id="email-error" class="invalid-feedback d-flex"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            {{ Form::text('subject',null , array_merge(['class' => $errors->has('subject') ? 'form-control  has-error': 'form-control','placeholder'=>__('Subject'),'data-validation'=>'required','data-validation-error-msg'=>__('This field is required'),'data-validation-error-msg-container'=>'#subject_error'])) }}
                                            <div id="subject_error" class="invalid-feedback d-flex"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            {{ Form::textarea('message_info',null , array_merge(['class' => $errors->has('message_info') ? ' form-control  has-error': ' form-control','placeholder'=>__('Enter Message'),'data-validation'=>'required','data-validation-error-msg'=>__('This field is required'),'data-validation-error-msg-container'=>'#message_error'])) }}
                                            <div id="message_error" class="invalid-feedback d-flex"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="send-btn">
                                             
                                            {{ Form::button(__('Send Message'),['class'=>'default-btn','id'=>'submitButton','type'=>'submit']) }}
                                             
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-info">
                            <div class="contact-info-content">
                                <h3>Contact with us by Your Phone Number or Email Address</h3>
                                <h2>
                                    <a href="tel:{{Helper::setting()->	number}}">{{Helper::setting()->	number}}</a>
                                    <span>Or</span>
                                    <a href="javascript:void(0):"><span class="__cf_email__">{{Helper::setting()->email}}</span></a>
                                </h2>
                                 
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
        </section>