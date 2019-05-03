@extends('admin.layouts.app')

@section('admin-content')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{ route('admin.index') }}">@lang('admin.breadcrumb.dashboard')</a>
    </li>
    <li class="breadcrumb-item active">@lang('admin.breadcrumb.overview')</li>
</ol>
<!-- Icon Cards-->
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">@lang('admin.card.messages')</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">@lang('admin.card.detail')</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="mr-5">@lang('admin.card.users', ['num' => $users->count()])</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#user">
                <span class="float-left">@lang('admin.card.detail')</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5">@lang('admin.card.orders', ['num' => $orders])</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#order">
                <span class="float-left">@lang('admin.card.detail')</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5">@lang('admin.card.requests', ['num' => $requests])</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#request">
                <span class="float-left">@lang('admin.card.detail')</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
</div>
<div class="card mb-3" id="user">
    <div class="card-header">
        <i class="fas fa-table"></i>
        @lang('admin.text.table_user')
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered dataTable">
                <thead>
                    <tr>
                        <th>@lang('admin.table.user.full_name')</th>
                        <th>@lang('admin.table.user.phone')</th>
                        <th>@lang('admin.table.user.address')</th>
                        <th>@lang('admin.table.user.birthday')</th>
                        <th>@lang('admin.table.user.email')</th>
                        <th>@lang('admin.table.created_at')</th>
                        <th>@lang('admin.table.status')</th>
                <tfoot>
                    <tr>
                        <th>@lang('admin.table.user.full_name')</th>
                        <th>@lang('admin.table.user.phone')</th>
                        <th>@lang('admin.table.user.address')</th>
                        <th>@lang('admin.table.user.birthday')</th>
                        <th>@lang('admin.table.user.email')</th>
                        <th>@lang('admin.table.created_at')</th>
                        <th>@lang('admin.table.status')</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->birthday }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
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
