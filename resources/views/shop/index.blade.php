@extends('layouts.app')
@section('title', 'Shop')

@section('content')

@component('partials.header')
    @slot('img')
        ../img/home-bg.jpg
    @endslot

    @slot('heading')
        @lang('common.text.shop_page.heading')
    @endslot

    @slot('subheading')
        @lang('common.text.shop_page.subheading')
    @endslot
@endcomponent

<div class="container">
    <div class="alert" role="alert">
        <strong class="alert-text"></strong>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h1 class="my-4">@lang('common.text.shop_page.category')</h1>
            @include('shop.components.categories', ['categories' => $categories])
            <h3 class="my-4">@lang('common.text.shop_page.filter_by_price')</h3>
            <div class="list-group">
                <input type="text" name="price_range" class="js-range-slider">
                <button type="btn" class="filter-price-btn btn btn-primary">@lang('common.form.button.submit')</button>
            </div>
        </div>
        <div class="col-lg-9">
            <h1 class="my-4">@lang('common.text.shop_page.available_product')</h1>
            <div class="row products-container">
                @forelse($products as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        <a href="{{ route('shop.show', $product->slug) }}"><img class="card-img-top" src="{{ asset($product->image) }}.jpg"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="{{ route('shop.show', $product->slug) }}">
                                    {{ $product->name }}
                                </a>
                            </h4>
                            <h5>{{ $product->price }}</h5>
                            <p class="card-text">{{ $product->description }} @lang('common.text.shop_page.buy')</p>
                        </div>
                        <div class="card-footer">
                            <button type="button" data-qty="{{ $product->stock_quantity }}" data-slug="{{ $product->slug }}" class="add-product btn btn-outline-primary float-right {{ $product->qty ? '' : 'disabled'}}">@lang('common.text.shop_page.buy')</button>
                        </div>
                    </div>
                </div>
                @empty
                    <h4>@lang('common.text.shop_page.no_product')</h4>
                @endforelse
            </div>
            <div class="float-right">{{ $products->appends(Request::only('price_range'))->links() }}</div>
            </div>
    </div>
</div>
@endsection
