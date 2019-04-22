<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a class="navbar-brand" href="#">@lang('common.text.nav.brand')</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav">
                <li class=" nav-item">
                    <a href="{{ route('welcome') }}" class="nav-link {{ Request::is('welcome') ? 'active' : '' }}">
                        @lang('common.text.nav.home')
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('shop.index') }}" class="nav-link
                    {{ Request::is('shop') ? 'active' : '' }}">@lang('common.text.nav.shop')
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            @lang('common.header.login')
                        </a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                @lang('common.header.register')
                            </a>
                        </li>
                    @endif
                @else
                    @include('partials.cart_nav_item')

                    <li class="dropdown nav-item">
                        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            {{ Auth::user()->full_name }}
                            <b class="caret"></b>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right animate slideIn">
                            <h6 class="dropdown-header ">@lang('common.text.nav.account_setting')</h6>
                            <a class="dropdown-item {{ Request::is('user/profile') ? 'active' : '' }}" href="{{ route('user.profile') }}">@lang('common.text.nav.profile')</a>

                            <a class="dropdown-item href="#">@lang('common.text.nav.cart')</a>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item" id="logout">
                                    @lang('common.header.logout')
                            </button>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
  <!-- /.container-->
</nav>
