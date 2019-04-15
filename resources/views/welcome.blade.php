@extends('layouts.app')
@section('title', 'Welcome')

@section('content')
@component('partials.header')
    @slot('img')
        img/home-bg.jpg
    @endslot

    @slot('heading')
        @lang('common.text.welcome_page.heading')
    @endslot

    @slot('subheading')
        @lang('common.text.welcome_page.subheading')
    @endslot
@endcomponent

<div class="container">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <!-- Slide One - Set the background image for this slide in the line below -->
            <div class="carousel-item active" style="background-image: url('img/products/ads-1.jpg')">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Laptop</h3>
                </div>
            </div>
            <!-- Slide Two - Set the background image for this slide in the line below -->
            <div class="carousel-item" style="background-image: url('img/products/ads-2.jpg')">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Phone</h3>
                </div>
            </div>
            <!-- Slide Three - Set the background image for this slide in the line below -->
            <div class="carousel-item" style="background-image: url('img/products/ads-3.jpg')">
                <div class="carousel-caption d-none d-md-block">
                    <h3>Game</h3>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
        data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
        data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <h2>@lang('common.text.welcome_page.trend_products')</h2>
    <div class="row">
        <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="{{ asset('img/products/phone-1.jpg') }}"></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">Product Two</a>
                    </h4>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="{{ asset('img/products/phone-1.jpg') }}"></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">Product Two</a>
                    </h4>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="{{ asset('img/products/phone-1.jpg') }}"></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">Product Two</a>
                    </h4>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="{{ asset('img/products/phone-1.jpg') }}"></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">Product Two</a>
                    </h4>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="{{ asset('img/products/phone-1.jpg') }}"></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">Product Two</a>
                    </h4>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="{{ asset('img/products/phone-1.jpg') }}"></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">Product Two</a>
                    </h4>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
