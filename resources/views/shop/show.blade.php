@extends('layouts.app')
@section('title', $product->name)

@section('meta-fb-share')
    <meta property="og:url" content="{{ URL::current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ $product->name }}" />
    <meta property="og:description" content="{{ $product->description }}" />
    <meta property="og:image" content="{{ asset($product->image) }}.jpg" />
@endsection

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
        <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">@lang('common.breadcrumb.shop')</a></li>
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
                    <button type="btn" class="btn-quantity btn-quantity-sub" data-slug="{{ $product->slug }}"
                        data-id="{{ $product->id }}">-</button>
                    <input type="text" class="input-quantity" id="item-{{ $product->slug }}" value="1">
                    <button type="btn" class="btn-quantity btn-quantity-plus" data-slug="{{ $product->slug }}"
                        data-id="{{ $product->id }}">+</button>
                </div>
            </div>
            <p class="font-weight-bolder">
                @if(!$product->qty)
                    <span class="badge badge-pill badge-danger">@lang('common.text.shop_page.single_product_page.out_of_stock')</span>
                @else
                    @lang('common.text.shop_page.single_product_page.in_stock', [
                    'num' => $product->stock_quantity])
                @endif
            </p>
            <button data-slug="{{ $product->slug }}" data-qty="{{ $product->stock_quantity }}"
                class="add-product btn btn-outline-danger
                {{ $product->qty ? '' : 'disabled'}}">
                @lang('common.text.shop_page.single_product_page.add_to_cart')
            </button>
            <div class="fb-share-button" data-href="{{ URL::current() }}" data-layout="button_count" data-size="large"></div>
        </div>
    </div>

    @include('shop.components.form.review')

    @include('shop.components.comment')

    @include('shop.components.recommend_product')

    @include('shop.components.recently_viewed_product')
    <div id="fb-root"></div>
</div>
@push('scripts')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5cca6a9e31fb5811"></script>
@endpush
@endsection
