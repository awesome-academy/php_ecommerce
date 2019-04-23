{!! Form::open([
    'method' => 'post',
    'route' => 'user.request',
]) !!}
    <div class="form-group row">
        {!! Form::label('product-name', 'Product name', [
            'class' => 'col-lg-3 col-form-label form-control-label',
            'id' => 'product-name',
        ]) !!}
        <div class="col-lg-9">
            {!! Form::text('product_name', '', [
                'id' => 'product-name',
                'class' => 'form-control',
            ]) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('description', 'Description', [
            'class' => 'col-lg-3 col-form-label form-control-label',
            'id' => 'description',
        ]) !!}
        <div class="col-lg-9">
            {!! Form::text('description', '', [
                'id' => 'description',
                'class' => 'form-control',
            ]) !!}
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-3 col-form-label form-control-label"></label>
        <div class="col-lg-9">
            {!! Form::submit(@trans('common.form.button.submit'), [
                'class' => 'btn btn-primary',
            ]) !!}
            <input type="reset" class="btn btn-secondary" value="Cancel">
        </div>
    </div>
{!! Form::close() !!}
