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
                        <th>@lang('admin.table.id')</th>
                        <th>@lang('admin.table.order.user_name')</th>
                        <th>@lang('admin.table.order.payment_type')</th>
                        <th>@lang('admin.table.order.total_price')</th>
                        <th>@lang('admin.table.status')</th>
                        <th>@lang('admin.table.created_at')</th>
                        <th>@lang('admin.table.action')</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>@lang('admin.table.id')</th>
                        <th>@lang('admin.table.order.user_name')</th>
                        <th>@lang('admin.table.order.payment_type')</th>
                        <th>@lang('admin.table.order.total_price')</th>
                        <th>@lang('admin.table.status')</th>
                        <th>@lang('admin.table.created_at')</th>
                        <th>@lang('admin.table.action')</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->full_name }}</td>
                        <td>{{ $order->payment->name }}</td>
                        <td>{{ $order->total_price }}</td>
                        <td><span class="badge badge-pill {{ $order->status['class'] }}">
                        {{ $order->status['lang'] }}</span></td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('orders.edit', $order->id) }}"><i class="fas fa-edit"></i></a>
                            <button class="delete-order" data-id="{{ $order->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
