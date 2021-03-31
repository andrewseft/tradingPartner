@extends('layouts.app_page')
@section('content')
    <!-- ***** Breadcrumb Area Start ***** -->
    <section class="section breadcrumb-area bg-overlay d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Breamcrumb Content -->
                    <div class="breadcrumb-content d-flex flex-column align-items-center text-center">
                        <h2 class="text-white text-capitalize">Frequently Asked Questions</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">{!! Html::decode(link_to_route('homePage',__('Home'),'#home',['class'=>"text-uppercase text-white"])) !!}</li>
                            <li class="breadcrumb-item text-white active">Faq</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('index.FAQ')
    @include('index.contact')
    <!--====== Height Emulator Area Start ======-->
    <div class="height-emulator d-none d-lg-block"></div>
    <!--====== Height Emulator Area End ======-->
@stop