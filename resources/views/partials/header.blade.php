<header class="masthead" style="background-image: url('{{ asset($img) }}')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>{{ $heading }}</h1>
                    <span class="subheading">{{ $subheading }}</span>
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</header>
