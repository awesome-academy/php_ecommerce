@extends('admin.layouts.app')

@section('admin-content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">@lang('admin.breadcrumb.dashboard')</a>
    </li>
    <li class="breadcrumb-item active">@lang('admin.breadcrumb.table_category')</li>
</ol>
@include('common.errors')
<div class="card mb-3" id="order">
    <div class="card-header">
        <i class="fas fa-table"></i>
        @lang('admin.text.table_category')
    </div>
    <div class="card-body">
        {!! Form::open([
            'route' => ['categories.store'],
            'method' => 'post',
        ]) !!}
            <div class="form-group row">
                {!! Form::label('name', @trans('admin.table.category.name'), [
                    'class' => 'col-lg-3 col-form-label form-control-label',
                ]) !!}
                <div class="col-lg-3">
                    <input type="text" name="name" value="{{ session('name') ? session('name') : '' }}"
                    class="form-control" id="name">
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('parent_id', @trans('admin.table.category.parent'), [
                    'class' => 'col-lg-3 col-form-label form-control-label',
                ]) !!}
                <div class="col-lg-3">
                    {!! Form::select('parent_id', $categories, '', ['class' => 'form-control']) !!}
                </div>
            </div>
            {!! Form::submit(@trans('common.form.button.submit'), ['class' => 'btn btn-primary']) !!}
            <button type="reset" class="btn btn-danger">@lang('common.form.button.reset')</button>
        {!! Form::close() !!}
    </div>
</div>
@endsection
