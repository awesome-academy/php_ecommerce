@extends('admin.layouts.app')

@section('admin-content')

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">@lang('admin.breadcrumb.dashboard')</a>
    </li>
    <li class="breadcrumb-item active">@lang('admin.breadcrumb.table_product')</li>
</ol>

<div class="card mb-3" id="order">
    <div class="card-header">
        <i class="fas fa-table"></i>
        @lang('admin.text.table_product')
    </div>
    <div class="card-body">
        {!! Form::open([
            'route' => ['products.update', $product->id],
            'method' => 'put',
        ]) !!}
            <div class="form-group row">
                {!! Form::label('name', @trans('admin.table.product.name'), [
                    'class' => 'col-lg-3 col-form-label form-control-label',
                    'id' => 'name',
                ]) !!}
                <div class="col-lg-9">
                    {!! Form::text('name', $product->name, [
                        'id' => 'name',
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('description', @trans('admin.table.product.description'), [
                    'class' => 'col-lg-3 col-form-label form-control-label',
                    'id' => 'description',
                ]) !!}
                <div class="col-lg-9">
                    {!! Form::text('description', $product->description, [
                        'id' => 'description',
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('category_id', @trans('admin.table.product.category'), [
                    'class' => 'col-lg-3 col-form-label form-control-label',
                    'id' => 'category_id',
                ]) !!}
                <div class="col-lg-3">
                    {!! Form::select('category_id', $categories, $product->categoryArray, [
                        'class' => 'form-control',
                        'id' => 'category_id',
                    ]) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('stock_quantity', @trans('admin.table.product.stock_quantity'), [
                    'class' => 'col-lg-3 col-form-label form-control-label',
                    'id' => 'stock_quantity',
                ]) !!}
                <div class="col-lg-3">
                    {!! Form::text('stock_quantity', $product->stock_quantity, [
                        'id' => 'stock_quantity',
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('price', @trans('admin.table.product.price'), [
                    'class' => 'col-lg-3 col-form-label form-control-label',
                    'id' => 'price',
                ]) !!}
                <div class="col-lg-3">
                    {!! Form::text('price', $product->price, [
                        'id' => 'price',
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </div>
            {!! Form::submit(@trans('common.form.button.submit'), ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection
