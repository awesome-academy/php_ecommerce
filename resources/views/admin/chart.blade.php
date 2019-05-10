@extends('admin.layouts.app')

@section('admin-content')

<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">@lang('admin.breadcrumb.dashboard')</a>
    </li>
    <li class="breadcrumb-item active">@lang('admin.breadcrumb.table_product')</li>
</ol>

<div class="chart-order row">
    <div class="col-md-6">
        {!! $chartMonth->html() !!}
    </div>
    <div class="col-md-6">
        {!! $chartYear->html() !!}
    </div>
</div>

{!! Charts::scripts() !!}
{!! $chartMonth->script() !!}
{!! $chartYear->script() !!}
@endsection
