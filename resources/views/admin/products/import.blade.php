{!! Form::open([
    'method' => 'post',
    'route' => 'products.import',
    'files' => 'true',
]) !!}
    <div class="form-group row">
        {!! Form::label('product_file', @trans('admin.table.product.file'), [
            'class' => 'col-lg-3 col-form-label form-control-label custom-file',
        ]) !!}
        <div class="col-lg-6 custom-file">
            {!! Form::file('product_file', [
                'class' => 'custom-file-input',
                'id' => 'product_file',
            ]) !!}
            {!! Form::label('product_file', @trans('admin.table.product.file'), [
                'class' => 'custom-file-label',
            ]) !!}
        </div>
    </div>
    {!! Form::submit(@trans('common.form.button.submit'), ['class'=>'btn btn-primary']) !!}
{!! Form::close() !!}
