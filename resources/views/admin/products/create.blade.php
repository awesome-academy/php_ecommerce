@extends('admin.layouts.app')

@section('admin-content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">@lang('admin.breadcrumb.dashboard')</a>
    </li>
    <li class="breadcrumb-item active">@lang('admin.breadcrumb.table_product')</li>
</ol>
@include('common.errors')
<div class="card mb-3" id="order">
    <div class="card-header">
        <i class="fas fa-table"></i>
        @lang('admin.text.table_product')
    </div>
    <div class="card-body">
        {!! Form::open([
            'route' => ['products.store'],
            'method' => 'post',
            'files' => 'true',
        ]) !!}

            <div class="form-group row">
                {!! Form::label('name', @trans('admin.table.product.name'), [
                    'class' => 'col-lg-3 col-form-label form-control-label',
                ]) !!}
                <div class="col-lg-9">
                    <input type="text" name="name" value="{{ session('name') ? session('name') : '' }}"
                    class="form-control" id="name">
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('description', @trans('admin.table.product.description'), [
                    'class' => 'col-lg-3 col-form-label form-control-label',
                ]) !!}
                <div class="col-lg-9">
                    <input type="textarea" name="description" value="{{ session('description') ?
                    session('description') : '' }}" class="form-control" id="description">
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('category_id', @trans('admin.table.product.category'), [
                    'class' => 'col-lg-3 col-form-label form-control-label',
                ]) !!}
                <div class="col-lg-3">
                    {!! Form::select('category_id', $categories, '', ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('stock_quantity', @trans('admin.table.product.stock_quantity'), [
                    'class' => 'col-lg-3 col-form-label form-control-label',
                ]) !!}
                <div class="col-lg-3">
                    {!! Form::text('stock_quantity', '', [
                        'id' => 'stock_quantity',
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('price', @trans('admin.table.product.price'), [
                    'class' => 'col-lg-3 col-form-label form-control-label',
                ]) !!}
                <div class="col-lg-3">
                    {!! Form::text('price', '', [
                        'id' => 'price',
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('image', @trans('admin.table.product.image'), [
                    'class' => 'col-lg-3 col-form-label form-control-label custom-file',
                ]) !!}
                <div class="col-lg-6 custom-file">
                    {!! Form::file('image', [
                        'class' => 'custom-file-input',
                        'id' => 'image',
                    ]) !!}
                    {!! Form::label('image', @trans('admin.table.product.image'), [
                        'class' => 'custom-file-label',
                    ]) !!}
                </div>
            </div>
            {!! Form::submit(@trans('common.form.button.submit'), ['class' => 'btn btn-primary']) !!}
            <button type="reset" class="btn btn-danger">@lang('common.form.button.reset')</button>
        {!! Form::close() !!}
    </div>
</div>
@endsection
