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
        @lang('admin.text.table_request')
    </div>
    <div class="card-body">
        {!! Form::open([
            'route' => 'products.requests.store',
            'method' => 'put',
        ]) !!}
            <div class="form-group row">
                {!! Form::hidden('id', $request->id, []) !!}
                {!! Form::label('status', @trans('admin.table.status'), [
                    'class' => 'col-lg-3 col-form-label form-control-label',
                    'id' => 'status',
                ]) !!}
                <div class="col-lg-9">
                    {!! Form::select('status', $optionStatus, $request->status['status'], [
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
