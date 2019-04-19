<div class="dropdown-divider"></div>
<h3>@lang('common.text.shop_page.single_product_page.also_like')</h3>
<div class="row product-container">
    @if($recommendProducts->count() > config('setting.product.number_recommendation_limit'))
        @foreach($recommendProducts as $recommendProduct)
        <div class="col-lg-3 col-sm-6 shadow-sm rounded product-item">
            <a href="{{ route('shop.show', $recommendProduct->slug) }}">
                <img class="img-fluid" src="{{ asset($recommendProduct->image) }}.jpg">
            </a>
            <a href="{{ route('shop.show', $recommendProduct->slug) }}">
                <caption>{{ $recommendProduct->name }}</caption>
            </a>
        </div>
        @endforeach
    @else
        <p>@lang('common.text.shop_page.single_product_page.no_product')</p>
    @endif
</div>
