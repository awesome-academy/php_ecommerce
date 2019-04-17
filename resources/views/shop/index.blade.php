@extends('layouts.app')
@section('title', 'Shop')

@section('content')

@component('partials.header')
    @slot('img')
        img/home-bg.jpg
    @endslot

    @slot('heading')
        @lang('common.text.shop_page.heading')
    @endslot

    @slot('subheading')
        @lang('common.text.shop_page.subheading')
    @endslot
@endcomponent

<div class="container">

    <div class="row">
        <div class="col-lg-3">
            <h1 class="my-4">@lang('common.text.shop_page.category')</h1>
            <div class="list-group">
                <a href="#" class="list-group-item">Phone</a>
                <a href="#" class="list-group-item">Desktop</a>
                <a href="#" class="list-group-item">Laptop</a>
                <a href="#" class="list-group-item">Gaming Gear</a>
                <a href="#" class="list-group-item">Appliance</a>
                <a href="#" class="list-group-item">Security</a>
            </div>
        </div>
        <div class="col-lg-9">
            <h1 class="my-4">@lang('common.text.shop_page.available_product')</h1>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="{{ asset('img/products/phone-1.jpg') }}" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Item One</a>
                            </h4>
                            <h5>$24.99</h5>
                            <p class="card-text">New Product. Available!! @lang('common.text.shop_page.buy')</p>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-outline-primary float-right">@lang('common.text.shop_page.buy')</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="{{ asset('img/products/phone-1.jpg') }}" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Item two</a>
                            </h4>
                            <h5>$24.99</h5>
                            <p class="card-text">New Product. Available!! @lang('common.text.shop_page.buy')</p>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-outline-primary float-right">@lang('common.text.shop_page.buy')</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="{{ asset('img/products/phone-1.jpg') }}" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Item three</a>
                            </h4>
                            <h5>$24.99</h5>
                            <p class="card-text">New Product. Available!! @lang('common.text.shop_page.buy')</p>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-outline-primary float-right">@lang('common.text.shop_page.buy')</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="{{ asset('img/products/phone-1.jpg') }}" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Item four</a>
                            </h4>
                            <h5>$24.99</h5>
                            <p class="card-text">New Product. Available!! @lang('common.text.shop_page.buy')</p>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-outline-primary float-right">@lang('common.text.shop_page.buy')</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="{{ asset('img/products/phone-1.jpg') }}" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Item five</a>
                            </h4>
                            <h5>$24.99</h5>
                            <p class="card-text">New Product. Available!! @lang('common.text.shop_page.buy')</p>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-outline-primary float-right">@lang('common.text.shop_page.buy')</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="{{ asset('img/products/phone-1.jpg') }}" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Item six</a>
                            </h4>
                            <h5>$24.99</h5>
                            <p class="card-text">New Product. Available!! @lang('common.text.shop_page.buy')</p>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-outline-primary float-right">@lang('common.text.shop_page.buy')</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="{{ asset('img/products/phone-1.jpg') }}" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Item Seven</a>
                            </h4>
                            <h5>$24.99</h5>
                            <p class="card-text">New Product. Available!! @lang('common.text.shop_page.buy')</p>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-outline-primary float-right">@lang('common.text.shop_page.buy')</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="{{ asset('img/products/phone-1.jpg') }}" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Item Eight</a>
                            </h4>
                            <h5>$24.99</h5>
                            <p class="card-text">New Product. Available!! @lang('common.text.shop_page.buy')</p>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-outline-primary float-right">@lang('common.text.shop_page.buy')</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="#"><img class="card-img-top" src="{{ asset('img/products/phone-1.jpg') }}" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#">Item Nine</a>
                            </h4>
                            <h5>$24.99</h5>
                            <p class="card-text">New Product. Available!! @lang('common.text.shop_page.buy')</p>
                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-outline-primary float-right">@lang('common.text.shop_page.buy')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
