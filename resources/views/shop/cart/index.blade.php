@extends('layouts.app')
@section('title', 'Your cart')

@section('content')

@component('partials.header')
    @slot('img')
        ../img/profile.jpg
    @endslot

    @slot('heading')
        @lang('common.text.shop_page.cart_page.heading')
    @endslot

    @slot('subheading')
        @lang('common.text.shop_page.cart_page.subheading')
    @endslot
@endcomponent

<div class="container">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('welcome') }}">@lang('common.breadcrumb.home')</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('shop.index') }}">@lang('common.breadcrumb.shop')</a>
        </li>
        <li class="breadcrumb-item active">@lang('common.breadcrumb.cart')</li>
    </ol>

    <div class="main-cart">
        @if($totalQty > @config('setting.product.number_recommendation_product'))
        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">@lang('common.table.product')</th>
                    <th scope="col">@lang('common.table.price')</th>
                    <th scope="col">@lang('common.table.quantity')</th>
                    <th scope="col">@lang('common.table.total')</th>
                    <th scope="col">@lang('common.table.action')</th>
                </tr>
            </thead>
            <tbody>
                @if (is_array($products) || is_object($products))
                    @foreach($products as $product)
                    <tr id="tr-product-{{ $product['item']['slug'] }}">
                        <th scope="row">1</th>
                        <td>
                            <div class="row">
                                <div class="col-lg-6">
                                    <img class="img-fluid" src="{{ asset($product['item']['image']) }}.jpg">
                                </div>
                                <div class="col-lg-6">
                                    <h3>{{ $product['item']['name'] }}</h3>
                                    <span>{{ $product['item']['description'] }}</span>
                                </div>
                            </div>
                        </td>
                        <td>{{ $product['item']['price'] }}</td>
                        <td>
                            <div class="qty">
                                <button type="btn" class="btn-quantity btn-quantity-sub"
                                data-slug="{{ $product['item']['slug'] }}"
                                data-id="{{ $product['item']['id'] }}">-</button>
                                <input name="qty" value="{{ $product['qty'] }}" class="input-quantity"
                                id="item-{{ $product['item']['slug'] }}">
                                <button type="btn" class="btn-quantity btn-quantity-plus"
                                data-slug="{{ $product['item']['slug'] }}"
                                data-id="{{ $product['item']['id'] }}">+</button>
                            </div>
                        </td>
                        <td><h6 id="price-product-{{ $product['item']['slug'] }}">{{ $product['price'] }}</h6></td>
                        <td>
                            <div class="remove-item-btn">
                                <a class="btn btn-outline-danger justify-content-center close remove-item-cart" data-slug="{{ $product['item']['slug'] }}"><i class="fa fa-times"></i></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="dropdown-divider"></div>
        <div class="row">
            <div class="col-lg-9 text-right">
                <h3 class="total-items-qty">@lang('common.cart.total_qty', ['qty' => $totalQty])</h3>
            </div>
            <div class="col-lg-3">
                <span class="cart-price">{{ $totalPrice }}</span>
            </div>
        </div>
        <div class="row mt-3 mb-5">
            <div class="col-lg-6 col sm-12">
                <a href="{{ route('shop.index') }}" class="btn btn-outline-primary">@lang('common.cart.continue_shopping')</a>
                <a href="{{ route('shop.index') }}" class="btn btn-outline-primary">@lang('common.cart.update_cart')</a>
            </div>
            <div class="col-lg-6 col sm-12">
                <a href="{{ route('order.index') }}" class="btn btn-primary float-right">@lang('common.cart.proceed_checkout')</a>
            </div>
        </div>
        @else
            <h3 class="text-center">@lang('common.text.not_purchase')</h3>
            <a href="{{ route('shop.index') }}" class="btn btn-outline-info mt-3 mb-5 d-flex justify-content-center">
                @lang('common.cart.buy_something')
            </a>
        @endif
    </div>

</div>
@endsection
