<div class="dropdown-divider"></div>
<h3>@lang('common.text.shop_page.single_product_page.review')</h3>
<div class="row mt-3 mb-5">
    @include('shop.components.rate')
    <div class="col-12 col-lg-6">
        <h3>@lang('common.text.shop_page.single_product_page.leave_comment')</h3>
        {!! Form::open([
            'route' => ['review.store', $product->slug],
            'method' => 'post',
        ]) !!}
            <div class="form-group row">
                {!! Form::label('content',
                    @trans('common.text.shop_page.single_product_page.comment'), [
                    'class' => 'col-md-4 col-form-label text-md-left'
                ]) !!}
                <div class="col-md-8">
                    {!! Form::text('content', '', [
                        'id' => 'content',
                        'class' => 'form-control'
                    ]) !!}
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('rating', @trans('common.text.shop_page.single_product_page.give_this'), [
                    'class' => 'col-md-4 col-form-label text-md-left'
                ]) !!}

                <div class="col-md-4">
                    <select name="rating">
                        @for($i = 1; $i <= @config('setting.product.number_rating'); $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>

                    @lang('common.text.shop_page.single_product_page.star')
                </div>
            </div>
            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    {!! Form::submit(@trans('common.form.button.submit'), [
                        'class' => 'btn btn-primary'
                    ]) !!}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
