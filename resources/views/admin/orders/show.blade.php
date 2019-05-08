@extends('admin.layouts.app')

@section('admin-content')

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">@lang('admin.breadcrumb.dashboard')</a>
    </li>
    <li class="breadcrumb-item active">@lang('admin.breadcrumb.table_order')</li>
</ol>
<div class="alert" role="alert">
    <strong class="alert-text"></strong>
</div>
<div class="card mb-3" id="order">
    <div class="card-header">
        <i class="fas fa-table"></i>
        @lang('admin.text.table_order')
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered dataTable">
                <thead>
                    <tr>
                        <th>@lang('admin.table.order.detail_image')</th>
                        <th>@lang('admin.table.order.detail_name')</th>
                        <th>@lang('admin.table.order.detail_qty')</th>
                        <th>@lang('admin.table.order.detail_price')</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>@lang('admin.table.order.detail_image')</th>
                        <th>@lang('admin.table.order.detail_name')</th>
                        <th>@lang('admin.table.order.detail_qty')</th>
                        <th>@lang('admin.table.order.detail_price')</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($order->products as $product)
                    <tr>
                        <td><img class="img-fluid admin-product-img"
                            src="{{ asset($product->image) }}.jpg"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>{{ $product->pivot->price}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
