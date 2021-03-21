<!-- ***** Header Start ***** -->
<header class="navbar navbar-sticky navbar-expand-lg navbar-dark navigation">
    <div class="container position-relative">
        <a class="navbar-brand" href="{{route('home')}}">
            {!! Html::image('img/logo.svg',null,['class'=>"navbar-brand-regular logoSize"]) !!}
            {!! Html::image('img/logo.svg',null,['class'=>"navbar-brand-sticky logoSize"]) !!}
        </a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-inner">
            <!--  Mobile Menu Toggler -->
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <nav>
                <ul class="navbar-nav" id="navbar-nav">
                    <li class="nav-item">
                        {!! Html::decode(link_to_route('homePage',__('Home'),'#home',['class'=>"nav-link"])) !!}
                    </li>
                    <li class="nav-item">
                        {!! Html::decode(link_to_route('homePage',__('Features'),'#features',['class'=>"nav-link"])) !!}
                    </li>
                    <li class="nav-item">
                        {!! Html::decode(link_to_route('homePage',__('Screenshots'),'#screenshots',['class'=>"nav-link"])) !!}
                    </li>
                    <li class="nav-item">
                        {!! Html::decode(link_to_route('homePage',__('How It Work'),'#how_it_work',['class'=>"nav-link"])) !!}
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('business.login')}}">Business User</a>
                    </li>
                    <li class="nav-item">
                        {!! Html::decode(link_to_route('homePage',__('Customer Queries'),'customer-queries',['class'=>"nav-link"])) !!}
                    </li>
                    <li class="nav-item">
                        <a class="nav-link scroll" href="#contact">Contact Us</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<!-- ***** Header End ***** -->