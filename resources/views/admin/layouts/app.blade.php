@extends('layouts.app')
@section('title', 'Admin')

@section('content')

@component('partials.header')
    @slot('img')
        ../img/home-bg.jpg
    @endslot

    @slot('heading')
        @lang('admin.text.heading')
    @endslot

    @slot('subheading')
        @lang('admin.text.subheading')
    @endslot
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 col-sm-12">
            @include('admin.partials.sidebar')
        </div>
        <div class="col-lg-10 col-sm-12">
            <div class="container-fluid text-center">
                @yield('admin-content')
            </div>
        </div>
    </div>
</div>
@endsection
