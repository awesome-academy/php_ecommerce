<li class="dropdown-cart dropdown nav-item">
    <a href="#" class="nav-link" data-toggle="dropdown">
        @lang('common.text.nav.cart')
        <span class="badge badge-pill badge-warning">4</span>
    </a>
    <div class="dropdown-menu-cart dropdown-menu dropdown-menu-right
                animate slideIn">
        <h4 class="dropdown-header">@lang('common.text.nav.your_cart')</h4>
        {{-- Data here --}}
        <div class="dropdown-divider"></div>
        <div class="navbar-cart-product">
           <div class="d-flex align-items-center">
                <a href="#">
                    <img class="navbar-cart-product-image" src="{{ asset('img/products/phone-1.jpg') }}">
                </a>
                <div class="w-100">
                    <a href="#" class="close text-sm mr-2">
                        <i class="fa fa-times"></i>
                    </a>
                    <div class="pl-3">
                        <h6 class="navbar-cart-product-link">product 1</h6>
                        <small class="d-block text-muted">Quantity: 1 </small>
                        <strong class="d-block text-sm">$75.00 </strong>
                    </div>
                </div>
            </div>
        </div>
        {{-- Footer --}}
        <div class="dropdown-divider"></div>
        <div class="row">
            <div class="col-sm-3">
                <h6 class="dropdown-item-text">@lang('common.text.nav.total')</h6>
            </div>
            <div class="col-sm-9">
                <h6 class="dropdown-item-text float-right">130.000 VND</h6>
            </div>
        </div>
        <div class="dropdown-divider"></div>
        <div class="row">
            <div class="col-sm-6">
                <a href="#" class="btn btn-outline-secondary dropdown-item">
                    @lang('common.text.nav.view_order')
                </a>
            </div>
            <div class="col-sm-6">
                <a href="#" class="btn btn-outline-info dropdown-item">
                    @lang('common.text.nav.checkout')
                </a>
            </div>
        </div>
    </div>
</li>
