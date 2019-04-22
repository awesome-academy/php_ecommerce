@extends('layouts.app')
@section('title', $product->name)

@section('content')

@component('partials.header')
    @slot('img')
        ../img/profile.jpg
    @endslot

    @slot('heading')
        @lang('common.text.shop_page.single_product_page.heading')
    @endslot

    @slot('subheading')
        @lang('common.text.shop_page.single_product_page.subheading')
    @endslot
@endcomponent

<div class="container">
    <h1 class="mt-4 mb-3">@lang('common.text.shop_page.single_product_page.product')
        <small>@lang('common.text.shop_page.single_product_page.detail_product')</small>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('welcome') }}">@lang('common.breadcrumb.home')</a>
        </li>
        <li class="breadcrumb-item"><a href="#">{{ $product->category->name }}</a></li>
        <li class="breadcrumb-item active">{{ $product->name }}</li>
    </ol>

    {{-- Start Intro content --}}
    <div class="row mb-5">
        <div class="col-lg-4">
            <img class="img-fluid rounded mb-4 product-img" src="{{ asset($product->image) }}.jpg">
        </div>
        <div class="col-lg-8 product-detail">
            <h2>{{ $product->name }}</h2>
            <p> {{ $product->description }}</p>
            <p class="font-weight-bold">{{ $product->price }}</p>
            <div class="qty-container">
                <p>@lang('common.text.shop_page.single_product_page.quantity')</p>
                <div class="qty">
                    <button type="btn" class="btn-quantity " >-</button>
                    <input type="text" class="input-quantity">
                    <button type="btn" class="btn-quantity  ">+</button>
                </div>
            </div>
            <p class="font-weight-bolder">
                {{ $product->stock_quantity }}
                @lang('common.text.shop_page.single_product_page.in_stock')
            </p>
            <a href="#" class="btn btn-outline-danger">
                @lang('common.text.shop_page.single_product_page.add_to_cart')
            </a>
        </div>
    </div>
    {{-- End Intro content --}}

    {{-- Start Write review section --}}
    @include('shop.components.form.review')
    {{-- End Write review section --}}

    {{-- Start Comment section --}}
    @include('shop.components.comment')
    {{-- End comment section --}}

    <!-- Start Also like Content -->
    @include('shop.components.recommend_product')
    {{-- End Also like Content --}}
</div>
@endsection
