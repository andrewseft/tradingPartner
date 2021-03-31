<section id="faq" class="faq-area ptb-100">
            <div class="container">
                <div class="section-title">
                    <h2>Frequently Asked Questions</h2>
                    <div class="bar"></div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incidiunt labore et
                        dolore magna aliqua. Quis ipsum suspendisse ultrices gravida.</p>
                </div>
                <div class="row align-items-center">
                @if($data->count())
                    <div class="col-lg-6">
                        <div class="faq-accordion-content">
                            <ul class="accordion">
                            @foreach($data as $key => $value)
                                @if($key == 0)
                                    <li class="accordion-item">
                                        <a class="accordion-title active" href="javascript:void(0)">
                                            <i class="fa fa-chevron-down"></i>{{Helper::mb_strtolower($value->detail->title)}}
                                        </a>
                                         {!! $value->detail->description !!} 
                                    </li>
                                @else
                                    <li class="accordion-item">
                                        <a class="accordion-title" href="javascript:void(0)">
                                            <i class="fa fa-chevron-down"></i> {{Helper::mb_strtolower($value->detail->title)}}
                                        </a>
                                         {!! $value->detail->description !!}
                                    </li>
                                @endif
                            @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                    <div class="col-lg-6">
                        <div class="faq-image">
                            <img src="{{URL::to('img/faq-mobile.png')}}" alt="image">
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