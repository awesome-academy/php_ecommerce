@extends('layouts.app')
@section('title', 'Profile')

@section('content')
@component('partials.header')
    @slot('img')
        ../img/profile.jpg
    @endslot

    @slot('heading')
        @lang('common.text.profile_page.heading')
    @endslot

    @slot('subheading')
        @lang('common.text.profile_page.subheading')
    @endslot
@endcomponent


<div class="container">
    <div class="row my-2">
        <div class="col-lg-8 order-lg-2">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">@lang('common.text.profile_page.profile')</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#order" data-toggle="tab" class="nav-link">@lang('common.text.profile_page.history')</a>
                </li>
                <li class="nav-item">
                    <a href="" data-target="#request" data-toggle="tab" class="nav-link">@lang('common.text.profile_page.request')</a>
                </li>

            </ul>
            <div class="tab-content py-4">
                <div class="tab-pane active" id="profile">
                    <h5 class="mb-3">@lang('common.text.profile_page.user_profile')</h5>
                    @include('common.message')
                    @include('common.errors')
                    {!! Form::open([
                        'route' => 'user.update',
                        'method' => 'post',
                    ]) !!}
                        <div class="form-group row">
                            {!! Form::label('first_name', @trans('common.form.label.first_name'), [
                                'class' => 'col-lg-3 col-form-label form-control-label',
                                'id' => 'first_name',
                            ]) !!}
                            <div class="col-lg-9">
                                {!! Form::text('first_name', $user->first_name, [
                                    'id' => 'first_name',
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('last_name', @trans('common.form.label.last_name'), [
                                'class' => 'col-lg-3 col-form-label form-control-label',
                                'id' => 'last_name',
                            ]) !!}
                            <div class="col-lg-9">
                                {!! Form::text('last_name', $user->last_name, [
                                    'id' => 'last_name',
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('email', @trans('common.form.label.email'), [
                                'class' => 'col-lg-3 col-form-label form-control-label',
                            ]) !!}
                            <div class="col-lg-9">
                                {!! Form::text('email', $user->email, [
                                    'class' => 'form-control',
                                    'readonly' => 'true',
                                ]) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('address', @trans('common.form.label.address'), [
                                'class' => 'col-lg-3 col-form-label form-control-label',
                            ]) !!}
                            <div class="col-lg-9">
                                {!! Form::text('address', $user->address, [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('phone', @trans('common.form.label.phone'), [
                                'class' => 'col-lg-3 col-form-label form-control-label',
                            ]) !!}
                            <div class="col-lg-9">
                                {!! Form::text('phone', $user->phone, [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('birthday', @trans('common.form.label.birthday'), [
                                'class' => 'col-lg-3 col-form-label form-control-label',
                            ]) !!}
                            <div class="col-lg-9">
                                {!! Form::date('birthday', $user->birthday, [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('password', @trans('common.form.label.password'), [
                                'class' => 'col-lg-3 col-form-label form-control-label',
                            ]) !!}
                            <div class="col-lg-9">
                                {!! Form::password('password', [
                                    'class' => 'form-control',
                                    'id' => 'password',
                                ]) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('password_confirm', @trans('common.form.label.password_confirm'), [
                                'class' => 'col-lg-3 col-form-label form-control-label',
                            ]) !!}
                            <div class="col-lg-9">
                                {!! Form::password('password_confirmation', [
                                    'class' => 'form-control',
                                    'id' => 'password_confirm',
                                ]) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                {!! Form::submit(@trans('common.form.button.submit'), [
                                    'class' => 'btn btn-primary',
                                ]) !!}
                                <input type="reset" class="btn btn-secondary" value="Cancel">
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <!--/row-->
                </div>
                <div class="tab-pane" id="order">
                    <div class="mt-3">
                    <span class="font-weight-bold alert alert-warning">@lang('common.text.profile_page.history_order')</span>
                    <table class="table table-hover table-striped mt-3">
                        <thead>
                            <tr>
                                <th>@lang('common.table.date')</th>
                                <th>@lang('common.table.order_id')</th>
                                <th>@lang('common.table.total')</th>
                                <th>@lang('common.table.status')</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                   <span class="font-weight-bold">2019-04-15 13:20:00</span>
                                </td>
                                <td>123</td>
                                <td>321.000 VND</td>
                                <td>Accepted</td>
                            </tr>
                            <tr>
                                <td>
                                   <span class="font-weight-bold">2019-04-15 13:20:00</span>
                                </td>
                                <td>123</td>
                                <td>321.000 VND</td>
                                <td>Accepted</td>
                            </tr><tr>
                                <td>
                                   <span class="font-weight-bold">2019-04-15 13:20:00</span>
                                </td>
                                <td>123</td>
                                <td>321.000 VND</td>
                                <td>Accepted</td>
                            </tr><tr>
                                <td>
                                   <span class="font-weight-bold">2019-04-15 13:20:00</span>
                                </td>
                                <td>123</td>
                                <td>321.000 VND</td>
                                <td>Accepted</td>
                            </tr><tr>
                                <td>
                                   <span class="font-weight-bold">2019-04-15 13:20:00</span>
                                </td>
                                <td>123</td>
                                <td>321.000 VND</td>
                                <td>Accepted</td>
                            </tr>

                        </tbody>
                    </table>
                    </div>
                    <div class="mt-5">
                    <span class="font-weight-bold alert alert-success">@lang('common.text.profile_page.request')</span>
                    <table class="table table-hover table-striped mt-3">
                        <thead>
                            <tr>
                                <th>@lang('common.table.date')</th>
                                <th>@lang('common.table.product_name')</th>
                                <th>@lang('common.table.product_description')</th>
                                <th>@lang('common.table.status')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($user->requestProducts as $product)
                            <tr>
                                <td>
                                   <span class="font-weight-bold">{{ $product->created_at }}</span>
                                </td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->description }}</td>
                                <td><span class="badge badge-pill {{ $product->status['class'] }}">
                                    {{ $product->status['lang'] }}</span></td>

                            </tr>
                            @empty
                                <tr><td colspan="4" class="text-center">@lang('common.text.profile_page.request_empty')</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="tab-pane" id="request">
                    <span class="font-weight-bold">@lang('common.text.profile_page.request')</span>
                    @include('user.request')
                </div>
            </div>
        </div>
        <div class="col-lg-4 order-lg-1 text-center">
            <img src="//placehold.it/150" class="mx-auto img-fluid img-circle d-block" alt="avatar">
            <h6 class="mt-2">@lang('common.text.profile_page.upload_photo')</h6>
            <label class="custom-file">
                <input type="file" id="file" class="custom-file-input">
                <span class="custom-file-control">@lang('common.text.profile_page.choose_file')</span>
            </label>
        </div>
    </div>
</div>
@endsection
