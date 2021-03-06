@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('common.header.register')</div>

                <div class="card-body">
                    @include('common.errors')
                    {!! Form::open([
                        'method' => 'post',
                        'route' => 'register',
                    ]) !!}
                        <div class="form-group row">
                            {!! Form::label('first_name', @trans('common.form.label.first_name'), [
                                'class' => 'col-md-4 col-form-label text-md-right'
                            ]) !!}

                            <div class="col-md-6">
                                {!! Form::text('first_name', '', [
                                    'id' => 'first_name',
                                    'class' => 'form-control',
                                ]) !!}

                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('last_name', @trans('common.form.label.last_name'), [
                                'class' => 'col-md-4 col-form-label text-md-right'
                            ]) !!}

                            <div class="col-md-6">
                                {!! Form::text('last_name', '', [
                                    'id' => 'last_name',
                                    'class' => 'form-control',
                                ]) !!}

                            </div>
                        </div>



                        <div class="form-group row">
                            {!! Form::label('email', @trans('common.form.label.email'), [
                                'class' => 'col-md-4 col-form-label text-md-right'
                            ]) !!}

                            <div class="col-md-6">
                                {!! Form::email('email', '', [
                                    'class' => 'form-control',
                                    'id' => 'email',
                                ]) !!}

                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('password', @trans('common.form.label.password'), [
                                'class' => 'col-md-4 col-form-label text-md-right'
                            ]) !!}

                            <div class="col-md-6">
                                {!! Form::password('password', [
                                    'class' => 'form-control',
                                    'id' => 'password',
                                ]) !!}

                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('password-confirm', @trans('common.form.label.password_confirm'), [
                                'class' => 'col-md-4 col-form-label text-md-right'
                            ]) !!}

                            <div class="col-md-6">
                                {!! Form::password('password_confirmation', [
                                    'class' => 'form-control',
                                    'id' => 'password-confirm',
                                ]) !!}
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {!! Form::submit(@trans('common.form.button.register'), [
                                    'class' => 'btn btn-primary',
                                ]) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
