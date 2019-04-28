@extends('admin.layouts.app')

@section('admin-content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">@lang('admin.breadcrumb.dashboard')</a>
    </li>
    <li class="breadcrumb-item active">@lang('admin.breadcrumb.table_product')</li>
</ol>

<div class="card mb-3" id="product">
    <div class="card-header">
        <i class="fas fa-table"></i>
        @lang('admin.text.table_product')
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered dataTable">
                <thead>
                    <tr>
                        <th>@lang('admin.table.product.image')</th>
                        <th>@lang('admin.table.product.name')</th>
                        <th>@lang('admin.table.product.description')</th>
                        <th>@lang('admin.table.product.category')</th>
                        <th>@lang('admin.table.product.stock_quantity')</th>
                        <th>@lang('admin.table.product.price')</th>
                        <th>@lang('admin.table.action')</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>@lang('admin.table.product.image')</th>
                        <th>@lang('admin.table.product.name')</th>
                        <th>@lang('admin.table.product.description')</th>
                        <th>@lang('admin.table.product.category')</th>
                        <th>@lang('admin.table.product.stock_quantity')</th>
                        <th>@lang('admin.table.product.price')</th>
                        <th>@lang('admin.table.action')</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>
                            <img class="img-fluid admin-product-img"
                            src="{{ asset($product->image) }}.jpg">
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->stock_quantity }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <a href=""><i class="fas fa-edit"></i></a>
                            <a href=""><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card mb-3" id="request">
    <div class="card-header">
        <i class="fas fa-table"></i>
        @lang('admin.text.table_request')
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered dataTable">
                <thead>
                    <tr>
                        <th>@lang('admin.table.id')</th>
                        <th>@lang('admin.table.order.user_name')</th>
                        <th>@lang('admin.table.product.name')</th>
                        <th>@lang('admin.table.product.description')</th>
                        <th>@lang('admin.table.status')</th>
                        <th>@lang('admin.table.created_at')</th>
                        <th>@lang('admin.table.action')</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>@lang('admin.table.id')</th>
                        <th>@lang('admin.table.order.user_name')</th>
                        <th>@lang('admin.table.product.name')</th>
                        <th>@lang('admin.table.product.description')</th>
                        <th>@lang('admin.table.status')</th>
                        <th>@lang('admin.table.created_at')</th>
                        <th>@lang('admin.table.action')</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->id }}</td>
                        <td>{{ $request->user->full_name }}</td>
                        <td>{{ $request->product_name }}</td>
                        <td>{{ $request->description }}</td>
                        <td><span class="badge badge-pill {{ $request->status['class'] }}">
                        {{ $request->status['lang'] }}</span></td>
                        <td>{{ $request->created_at }}</td>
                        <td>
                            <a href=""><i class="fas fa-edit"></i></a>
                            <a href=""><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
