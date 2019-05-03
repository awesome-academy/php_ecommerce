<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>@lang('admin.sidebar.dashboard')</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-table"></i>
            <span>@lang('admin.sidebar.tables')</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">@lang('admin.sidebar.tables'):</h6>
            <a class="dropdown-item" href="#">@lang('admin.sidebar.users')</a>
            <a class="dropdown-item" href="{{ route('products.index') }}">@lang('admin.sidebar.products')</a>
            <a class="dropdown-item" href="{{ route('orders.index') }}">@lang('admin.sidebar.orders')</a>
            <a class="dropdown-item" href="#">@lang('admin.sidebar.categories')</a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>@lang('admin.sidebar.charts')</span></a>
    </li>
</ul>
