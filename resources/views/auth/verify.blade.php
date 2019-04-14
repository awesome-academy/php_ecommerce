@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('common.header.verify')</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            @lang('common.text.verification_link_reset')
                        </div>
                    @endif

                    @lang('common.text.check_verify')
                    @lang('common.text.receive_email'), <a href="{{ route('verification.resend') }}">@lang('common.text.request_email')</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
