@extends('admin.layouts.app')

@section('admin-content')

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">@lang('admin.breadcrumb.dashboard')</a>
    </li>
    <li class="breadcrumb-item active">@lang('admin.breadcrumb.table_category')</li>
</ol>

<div class="card mb-3" id="order">
    <div class="card-header">
        <i class="fas fa-table"></i>
        @lang('admin.text.table_category')
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                {!! Form::open([
                    'route' => ['categories.update', $category->id],
                    'method' => 'put',
                ]) !!}
                <div class="form-group row">
                    {!! Form::label('name', @trans('admin.table.category.name'), [
                        'class' => 'col-lg-4 col-form-label form-control-label',
                        'id' => 'name',
                    ]) !!}
                    <div class="col-lg-8">
                        {!! Form::text('name', $category->name, [
                            'id' => 'name',
                            'class' => 'form-control',
                        ]) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('parent_id', @trans('admin.table.category.parent'), [
                        'class' => 'col-lg-4 col-form-label form-control-label',
                        'id' => 'parent_id',
                    ]) !!}
                    <div class="col-lg-3">
                        {!! Form::select('parent_id', $options, $category->name, [
                            'class' => 'form-control',
                            'id' => 'parent_id',
                        ]) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        {!! Form::submit(@trans('common.form.button.update'), ['class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
                    <div class="col-lg-6">
                        {!! Form::open([
                            'route' => ['categories.destroy', $category->id],
                            'method' => 'delete',
                        ]) !!}
                            {!! Form::submit(@trans('common.form.button.delete'), ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                @forelse($category->products as $product)
                    <div class="row mt-3">
                        <div class="col-lg-6">
                            <img src="{{ asset($product->image) }}.jpg" class="img-fluid admin-product-img">
                        </div>
                        <div class="col-lg-6">
                            <a href="{{ route('products.edit', $product->id) }}">{{ $product->name }}</a>
                        </div>
                    </div>
                    @empty
                        <span class="small font-weight-bold">@lang('admin.text.no_product')</span>
                        <a href="{{ route('products.create') }}" class="btn btn-info"><i class="fas fa-plus"></i>@lang('admin.button.add_more')</a>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
