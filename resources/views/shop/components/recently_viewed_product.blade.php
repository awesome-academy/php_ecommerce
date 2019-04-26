<div class="viewed-product-container mt-5 mb-5">
    <div class="dropdown-divider mb-3"></div>
    <h3>@lang('common.text.shop_page.single_product_page.viewed_product')</h3>
    <div class="row product-container">
        @if(count($viewedProducts) > config('setting.product.number_recommendation_limit'))
            @foreach($viewedProducts as $product)
            <div class="col-lg-3 col-sm-6 shadow-sm rounded product-item mb-3">
                <a href="{{ route('shop.show', $product->slug) }}">
                    <img class="img-fluid" src="{{ asset($product->image) }}.jpg">
                </a>
                <a href="{{ route('shop.show', $product->slug) }}">
                    <caption>{{ $product->name }}</caption>
                </a>
            </div>
            @endforeach
        @else
            <p>@lang('common.text.shop_page.single_product_page.no_product')</p>
        @endif
    </div>
</div>
