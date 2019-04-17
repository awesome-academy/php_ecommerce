@if (session('message'))
    <div class="alert alert-{{ session('level') }}" role="alert">
        <strong>{{ session('message') }}</strong>
    </div>
@endif
