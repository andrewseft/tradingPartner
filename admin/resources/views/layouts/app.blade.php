<!doctype html>
<html lang="zxx">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        {{ Html::style('css/app/bootstrap.min.css') }}
        {{ Html::style('css/app/animate.min.css') }}
        {{ Html::style('css/app/owl.carousel.min.css') }}
        {{ Html::style('css/app/odometer.css') }}
        {{ Html::style('css/app/magnific-popup.min.css') }}
        {{ Html::style('css/app/slick.min.css') }}
        {{ Html::style('css/app/style.css') }}
        {{ Html::style('css/app/responsive.css') }}
        <title>Banknifty</title>
        <link rel="icon" type="image/png" href="{{URL::to('img/logo.png')}}">
    </head>

    <body data-spy="scroll" data-offset="120">

        <div class="preloader">
            <div class="preloader">
                <span></span>
                <span></span>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="logo">
                    <a href="{{route('home')}}">
                        <img src="{{URL::to('img/logo.png')}}" alt="image">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="javascript::void(#);navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#home" class="nav-link">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#whatwe-offers" class="nav-link">
                                What We Offer
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#about" class="nav-link">
                                Why Us
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#features" class="nav-link">
                                Features
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#faq" class="nav-link">
                                Faq's
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#reachUs" class="nav-link">
                                Reach Us
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#contact" class="nav-link">
                                Downloads
                            </a>
                        </li>
                    </ul>
                    <div class="others-option">
                        <div class="d-flex align-items-center">
                            <div class="option-item">
                                <a href="javascript:voide(0);" class="default-btn"> SignIn<span></span></a>
                            </div>
                            <div class="option-item ml-10">
                                <a href="javascript:voide(0);" class="default-btn">SignUp<span></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
         @yield('content')
         <section class="footer-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="single-footer-widget">
                            <a href="javascript::void(#);" class="logo">
                                
                                <img src="{{URL::to('img/logo.png')}}" alt="image">
                            </a>
                            <p>The information contained in this Website is intended to provide Users with objective information about the Portfolio management services and strategies, and financial products and services of bankniftypms.com.</p>
                            <ul class="social-list">
                                <li>
                                    <a href="javascript::void(#);">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript::void(#);">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript::void(#);">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript::void(#);">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="single-footer-widget pl-5">
                            <h3>Company</h3>
                            <ul class="list">
                                <li>
                                    {!! Html::decode(link_to_route('homePage',__('Privacy Policy'),'privacy-policy',['class'=>""])) !!}
                                </li>
                                <li>
                                    {!! Html::decode(link_to_route('homePage',__('Cancellation Policy'),'cancellation-policy',['class'=>""])) !!}
                                </li>
                                <li>
                                    {!! Html::decode(link_to_route('homePage',__('Return Policy'),'return-policy',['class'=>""])) !!}
                                </li>
                                <!-- <li>
                                    {!! Html::decode(link_to_route('homePage',__('Refund Policy'),'refund-policy',['class'=>""])) !!}
                                </li> -->
                                <li>
                                    {!! Html::decode(link_to_route('homePage',__('Terms and Conditions'),'terms-conditions',['class'=>""])) !!}
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6">
                        <div class="single-footer-widget">
                            <h3>Download</h3>
                            <ul class="footer-holder">
                                <li>
                                    <a href="javascript::void(#);">
                                        <img src="{{URL::to('img/1.png')}}" alt="image">
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript::void(#);">
                                        <img src="{{URL::to('img/2.png')}}" alt="image">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="copy-right">
            <div class="container">
                <div class="copy-right-content">
                    <p>
                         {{Helper::setting()->copy_right}}
                         
                    </p>
                </div>
            </div>
        </div>
        <div class="go-top">
            <i class="fa fa-chevron-up"></i>
            <i class="fa fa-chevron-up"></i>
        </div>

        {{ Html::script('js/app/email-decode.min.js', ['type' => 'text/javascript']) }}
        {{ Html::script('js/app/jquery-3.5.1.min.js', ['type' => 'text/javascript']) }}
        {{ Html::script('js/app/popper.min.js', ['type' => 'text/javascript']) }}
        {{ Html::script('js/app/bootstrap.min.js', ['type' => 'text/javascript']) }}
        {{ Html::script('js/app/owl.carousel.min.js', ['type' => 'text/javascript']) }}
        {{ Html::script('js/app/jquery.appear.js', ['type' => 'text/javascript']) }}
        {{ Html::script('js/app/odometer.min.js', ['type' => 'text/javascript']) }}
        {{ Html::script('js/app/slick.min.js', ['type' => 'text/javascript']) }}
        {{ Html::script('js/app/particles.min.js', ['type' => 'text/javascript']) }}
        {{ Html::script('js/app/jquery.ripples-min.js', ['type' => 'text/javascript']) }}
        {{ Html::script('js/app/jquery.magnific-popup.min.js', ['type' => 'text/javascript']) }}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.36/jquery.form-validator.min.js"></script>
        {{ Html::script('js/admin/validate.js', ['type' => 'text/javascript']) }}
        {{ Html::script('js/app/main.js', ['type' => 'text/javascript']) }}
         
    </body>

</html>