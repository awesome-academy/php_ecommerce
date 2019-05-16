@extends('admin.layouts.app')

@section('admin-content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">@lang('admin.breadcrumb.dashboard')</a>
    </li>
    <li class="breadcrumb-item active">@lang('admin.breadcrumb.table_category')</li>
</ol>

<div class="alert" role="alert">
    <strong class="alert-text"></strong>
</div>
@include('common.message')
<div class="card mb-3" id="product">
    <div class="card-header">
        <i class="fas fa-table"></i>
        @lang('admin.text.table_category')
        <div class="text-right">
            <a href="{{ route('categories.create') }}" class="btn btn-info"><i class="fas fa-plus"></i>
            @lang('admin.button.add')</a>
        </div>
    </div>
    <div class="card-body">
        <div class="category-container text-left">
            @include('admin.categories.categories', ['categories' => $categories])
        </div>
    </div>
</div>
@endsection
