<div class="modal fade" id="detailModal">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center">@lang('common.text.shop_page.cart_page.order_detail')</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <table id="detail-order-table" class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>@lang('common.table.image')</th>
                            <th>@lang('common.table.product_name')</th>
                            <th>@lang('common.table.quantity')</th>
                            <th>@lang('common.table.price')</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">@lang('common.form.button.close')</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
