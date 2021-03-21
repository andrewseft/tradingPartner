@extends('layouts.app_page')
@section('content')
<section id="about" class="about-area pb-100">
        <div class="container">
            <div class="section-title">
                <h2>{{$data->detail->title}}</h2>
                <div class="bar"></div>
                
            </div>
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="about-content">
                        {!! $data->detail->description !!}
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
    </section>
@stop