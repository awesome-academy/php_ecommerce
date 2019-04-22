@forelse($reviews as $review)
<div class="row mb-5">
    <div class="col-md-2">
        <div class="user-thumbnail">
            <img class="user-photo" src="{{ asset('/img/users/default.png') }}"
            alt="Avatar">
        </div>
    </div>

    <div class="col-md-10">
        <div class="card">
            <div class="card-header comment-header">
                <div>
                    <strong>{{ $review->user->full_name }}</strong>
                    <span class="text-muted">
                        @lang('common.text.shop_page.single_product_page.commented_at')
                        {{ $review->created_at->diffForHumans() }} :</span>
                </div>
                <div>
                    @for ($i = 1; $i <= @config('setting.product.number_rating'); $i++)
                      <span class="float-left">
                        <i class="fa fa-star {{ ($i <= $review->rating) ? 'text-warning' : ''}}"></i></span>
                    @endfor
                </div>
            </div>
            <div class="card-body">{{ $review->content }} </div>
        </div>
    </div>
</div>
@empty
<p class="text-center">@lang('common.text.shop_page.single_product_page.no_comment')</p>
@endforelse
<div class="float-right">{{ $reviews->links() }}</div>
