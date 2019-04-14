@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('common.header.login')</div>

                <div class="card-body">
                    {!! Form::open([
                        'method' => 'post',
                        'route' => 'login',
                    ]) !!}
                        <div class="form-group row">
                            {!! Form::label('email', @trans('common.form.label.email'), [
                                'class' => 'col-md-4 col-form-label text-md-right'
                            ]) !!}
                            <div class="col-md-6">
                                {!! Form::email('email', '', [
                                    'id' => 'email',
                                    'class' => 'form-control'
                                ]) !!}

                                @include('common.errors')
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('password', @trans('common.form.label.password'), [
                                'class' => 'col-md-4 col-form-label text-md-right'
                            ]) !!}

                            <div class="col-md-6">
                                {!! Form::password('password', [
                                    'class' => 'form-control',
                                    'id' => 'password'
                                ]) !!}

                                @include('common.errors')
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    {!! Form::checkbox('remember', old('remember')?'checked':'', [
                                        'class' => 'form-check-input'
                                    ]) !!}
                                    {!! Form::label('remember', trans('common.form.label.remember_me'), [
                                        'class' => 'form-check-label'
                                    ]) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                {!! Form::submit(@trans('common.form.button.login'), [
                                    'class' => 'btn btn-primary'
                                ]) !!}
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        @lang('common.form.label.password_reset')
                                    </a>
                                @endif
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
