@extends('admin.layouts.app')

@section('admin-content')

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">@lang('admin.breadcrumb.dashboard')</a>
    </li>
    <li class="breadcrumb-item active">@lang('admin.breadcrumb.table_order')</li>
</ol>

<div class="card mb-3" id="order">
    <div class="card-header">
        <i class="fas fa-table"></i>
        @lang('admin.text.table_order')
    </div>
    <div class="card-body">
        {!! Form::open([
            'route' => ['orders.update', $order->id],
            'method' => 'put',
        ]) !!}

            <div class="form-group row">
                {!! Form::label('user_name', @trans('admin.table.order.user_name'), [
                    'class' => 'col-lg-3 col-form-label form-control-label',
                    'id' => 'user_name',
                ]) !!}
                <div class="col-lg-9">
                    {!! Form::text('user_name', $order->user->full_name, [
                        'id' => 'user_name',
                        'class' => 'form-control',
                        'readonly' => 'true',
                    ]) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('payment_type', @trans('admin.table.order.payment_type'), [
                    'class' => 'col-lg-3 col-form-label form-control-label',
                    'id' => 'payment_type',
                ]) !!}
                <div class="col-lg-9">
                    {!! Form::select('payment_id', $payments, $order->payment_id, [
                        'class' => 'form-control',
                        'id' => 'payment_type',
                    ]) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('total_price', @trans('admin.table.order.total_price'), [
                    'class' => 'col-lg-3 col-form-label form-control-label',
                ]) !!}
                <div class="col-lg-9">
                    {!! Form::text('total_price', $order->total_price, [
                        'class' => 'form-control',
                        'id' => 'total_price',
                    ]) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('status', @trans('admin.table.status'), [
                    'class' => 'col-lg-3 col-form-label form-control-label',
                    'id' => 'status',
                ]) !!}
                <div class="col-lg-9">
                    {!! Form::select('status', $optionStatus, $order->status['status'], [
                        'class' => 'form-control',
                        'id' => 'status',
                    ]) !!}
                </div>
            </div>
            {!! Form::submit(@trans('common.form.button.submit'), ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection
