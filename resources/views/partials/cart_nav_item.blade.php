<li class="dropdown-cart dropdown nav-item">
    <a href="#" class="nav-link" data-toggle="dropdown">
        @lang('common.text.nav.cart')
        <span class="badge badge-pill badge-warning cart-qty">
            @if (session('cart'))
                {{ session('cart')->totalQty }}
            @else
                0
            @endif
        </span>
    </a>
    <div class="dropdown-menu-cart dropdown-menu dropdown-menu-right
                animate slideIn">
        <h4 class="dropdown-header">@lang('common.text.nav.your_cart')</h4>
        {{-- Data here --}}
            @if (is_array($products) || is_object($products))
                @foreach($products as $product)
                    <div class="dropdown-divider"></div>
                    <div class="navbar-cart-product">
                       <div class="d-flex align-items-center">
                            <a href="#">
                                <img class="navbar-cart-product-image"
                                src="{{ asset($product['item']['image']) }}.jpg">
                            </a>
                            <div class="w-100">
                                <a class="close text-sm mr-2 remove-item-cart"
                                data-slug="{{ $product['item']['slug'] }}">
                                    <i class="fa fa-times"></i>
                                </a>
                                <div class="pl-3">
                                    <h6 class="navbar-cart-product-link">{{ $product['item']['name'] }}</h6>
                                    <small id="cart-item-qty-{{ $product['item']['id'] }}" class="d-block text-muted">@lang('common.text.nav.quantity', ['qty' => $product['qty']])</small>
                                    <strong class="d-block text-sm">{{ $product['price'] }} </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="cart-item-container"></div>
            {{-- Footer --}}
            <div class="dropdown-divider"></div>
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="dropdown-item-text">@lang('common.text.nav.total')</h6>
                </div>
                <div class="col-sm-9">
                    <h6 class="dropdown-item-text float-right cart-price">{{ $totalPrice }}</h6>
                </div>
            </div>

        <div class="dropdown-divider"></div>
        <div class="row">
            <div class="col-sm-6">
                <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary dropdown-item">
                    @lang('common.text.nav.view_order')
                </a>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('order.index') }}" class="btn btn-outline-info dropdown-item">
                    @lang('common.text.nav.checkout')
                </a>
            </div>
        </div>
    </div>
</li>
