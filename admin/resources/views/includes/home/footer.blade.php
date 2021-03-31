<!--====== Footer Area Start ======-->
<footer class="footer-area footer-fixed">
    <!-- Footer Top -->
    <div class="footer-top ptb_100">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-3">
                    <!-- Footer Items -->
                    <div class="footer-items">
                        <!-- Logo -->
                        <a class="navbar-brand" href="#">
                            {!! Html::image('img/logo.svg',null,['class'=>"logo"]) !!}
                        </a>
                        <p class="mt-2 mb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis non, fugit totam vel laboriosam vitae.</p>
                        <!-- Social Icons -->
                        <div class="social-icons d-flex">
                            <a class="facebook" href="javascript::void(0);">
                                <i class="fab fa-facebook-f"></i>
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="twitter" href="javascript::void(0);">
                                <i class="fab fa-twitter"></i>
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="google-plus" href="javascript::void(0);">
                                <i class="fab fa-instagram"></i>
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <!-- Footer Items -->
                    <div class="footer-items">
                        <!-- Footer Title -->
                        <h3 class="footer-title mb-2">Useful Links</h3>
                        <ul>
                            <li class="py-2"><a href="javascript::void(0);">Home</a></li>
                            <li class="py-2">{!! Html::decode(link_to_route('homePage',__('About Us'),'about-us',['class'=>""])) !!}</li>
                            <li class="py-2"><a class="scroll" href="#contact">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <!-- Footer Items -->
                    <div class="footer-items">
                        <!-- Footer Title -->
                        <h3 class="footer-title mb-2">Support</h3>
                        <ul>
                            <li class="py-2">{!! Html::decode(link_to_route('homePage',__('Faq'),'faq',['class'=>""])) !!}</li>
                            <li class="py-2">{!! Html::decode(link_to_route('homePage',__('How It Work'),'how-it-work',['class'=>""])) !!}</li>
                            <li class="py-2">{!! Html::decode(link_to_route('homePage',__('Privacy Policy'),'privacy-policy',['class'=>""])) !!}</li>
                            <li class="py-2">{!! Html::decode(link_to_route('homePage',__('Terms and Conditions'),'terms-conditions',['class'=>""])) !!}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <!-- Footer Items -->
                    <div class="footer-items">
                        <!-- Footer Title -->
                        <h3 class="footer-title mb-2">Download</h3>
                        <!-- Store Buttons -->
                        <div class="button-group store-buttons store-black d-flex flex-wrap">
                            <a href="javascript::void(0);">
                                {!! Html::image('img/app/google-play-black.png',null,['class'=>"logo"]) !!}
                            </a>
                            <a href="javascript::void(0);">
                                {!! Html::image('img/app/app-store-black.png',null,['class'=>"logo"]) !!}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Copyright Area -->
                    <div class="copyright-area d-flex flex-wrap justify-content-center justify-content-sm-between text-center py-4">
                        <!-- Copyright Left -->
                        <div class="copyright-left">&copy; {{Helper::setting()->copy_right}}</div>
                        <!-- Copyright Right -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--====== Footer Area End ======-->