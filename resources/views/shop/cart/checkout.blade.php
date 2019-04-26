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

    <div class="main-checkout mt-5">
        <h1 class="text-center">@lang('common.text.shop_page.cart_page.check_order_detail')</h1>
        <div class="row mt-5 mb-5">
            <div class="col-lg-6 col-12">
                {!! Form::open([
                    'route' => 'order.store',
                    'method' => 'post',
                ]) !!}
                    <div class="form-group row">
                        <div class="col-md-6">
                            {!! Form::label('first_name', @trans('common.form.label.first_name'), [
                                'class' => 'form-control-label',
                            ]) !!}
                            {!! Form::text('first_name', $user->first_name, [
                                'class' => 'form-control',
                                'required' => 'required',
                                'readonly' => 'true',
                                'id' => 'first_name',
                            ]) !!}
                        </div>

                        <div class="col-md-6">
                            {!! Form::label('last_name', @trans('common.form.label.last_name'), [
                                'class' => 'form-control-label',
                            ]) !!}
                            {!! Form::text('last_name', $user->last_name, [
                                'class' => 'form-control',
                                'required' => 'required',
                                'readonly' => 'true',
                                'id' => 'last_name',
                            ]) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            {!! Form::label('address', @trans('common.form.label.address'), [
                                'class' => 'form-control-label',
                            ]) !!}
                            {!! Form::text('address', $user->address, [
                                'class' => 'form-control',
                                'required' => 'required',
                                'id' => 'address',
                            ]) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            {!! Form::label('phone', @trans('common.form.label.phone'), [
                                'class' => 'form-control-label',
                            ]) !!}
                            {!! Form::text('phone', $user->phone, [
                                'class' => 'form-control',
                                'required' => 'required',
                                'id' => 'phone',
                            ]) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            {!! Form::label('payment_name', @trans('common.form.label.payment_name'), [
                                'class' => 'form-control-label',
                            ]) !!}
                            {!! Form::select('payment_name', $payments, '', [
                                'class' => 'form-control',
                                'required' => 'required',
                                'id' => 'selection-box',
                            ]) !!}
                        </div>
                    </div>
                    <small>@lang('common.text.shop_page.cart_page.order_note')</small>
                    <div class="form-group row mt-3">
                        <div class="col-lg-12">
                            {!! Form::submit(@trans('common.form.button.submit'), [
                                'class' => 'btn btn-primary',
                            ]) !!}
                            <input type="reset" class="btn btn-secondary" value="Cancel">
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="col-lg-6 col-12">
                <div class="order-container">
                    <h3 class="text-center">@lang('common.text.shop_page.cart_page.order_detail')</h3>
                    <table class="table table-hover table-striped mt-3">
                        <thead class="text-center">
                            <tr>
                                <th>@lang('common.table.product')</th>
                                <th>@lang('common.table.total')</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @if (is_array($products) || is_object($products))
                                @foreach($products as $product)
                                <tr>
                                    <td>
                                        @lang('common.text.shop_page.cart_page.order_detail_item', [
                                            'name' => $product['item']['name'],
                                            'qty' => $product['qty'],
                                        ])
                                    </td>
                                    <td>{{ $product['price'] }}</td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="dropdown-divider"></div>
                    <div class="row text-center order-total">
                        <div class="col-lg-6 col-md-9">
                            <h3 id="order-qty-total text-center">@lang('common.cart.total_qty', ['qty' => $totalQty])</h3>
                        </div>
                        <div class="col-lg-6 col-md-3">
                            <span class="font-weight-bold text-center">{{ $totalPrice }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
