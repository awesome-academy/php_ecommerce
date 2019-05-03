
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./clean-blog.js')
require('./logout.js')
require('./subiz-chat.js')

function addDeleteListener () {
    $('.remove-item-cart').on('click', function () {
        var productSlug = $(this).attr('data-slug');
        var url = "/cart/" + productSlug;
        var parent = $(this).parents();
        $.ajax(
        {
            url: url,
            data: productSlug,
            method: 'delete',
            success: function (response)
            {
                $('.alert').addClass('alert-' + response.level);
                $('.alert').css('display', 'none');
                $('.alert-text').html(response.message);
                $('.alert').fadeIn(2000);

                setTimeout(function () {
                    $('.alert').fadeOut(1000);
                }, 3000);

                parent[2].remove();
                $('.cart-qty').html(response.cart.totalQty);
                $('.cart-price').html(response.cart.totalPrice);
                $('.total-items-qty').html("Total " + response.cart.totalQty + " item(s)");
            },
        });
    });
}

function appendDataCart (response, itemId, itemslug, inputQty) {
    $('.cart-qty').html(response.cart.totalQty);
    $('.cart-price').html(response.cart.totalPrice);
    $('.total-items-qty').html("Total " + response.cart.totalQty + " item(s)");
    $('#cart-item-qty-' + itemId).html("Quantity: " + inputQty);
    $('#price-product-' + itemslug).html(response.cart.items[itemId].price);
}

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.add-product').on('click', function () {
        var productSlug = $(this).attr('data-slug');
        var url = "/cart/" + productSlug;
        var itemId = "id='cart-item-'";
        $.ajax(
        {
            url: url,
            method: 'post',
            data: productSlug,
            success: function (response)
            {
                $('.alert').addClass('alert-' + response.level);
                $('.alert').css('display', 'none');
                $('.alert-text').html(response.message);
                $('.alert').fadeIn(2000);

                setTimeout(function () {
                    $('.alert').fadeOut(1000);
                }, 3000);

                $('.cart-item-container').append(
                    "<div class='dropdown-divider'></div>" +
                    "<div class='navbar-cart-product'>" +
                       "<div class='d-flex align-items-center'>" +
                            "<a href='#'><img class='navbar-cart-product-image' " +
                                "src='" + response.product.image + ".jpg'" + "></a> " +
                            "<div class='w-100'> " +
                                "<a class='close text-sm mr-2 remove-item-cart' data-slug='"
                                + response.product.slug + "'> " +
                                    "<i class='fa fa-times'></i></a> " +
                                "<div class='pl-3'> " +
                                    "<h6 class='navbar-cart-product-link'> "
                                    + response.product.name + "</h6>" +
                                    "<small id='cart-item-qty-" + response.product.id +
                                    "' class='d-block text-muted'>Quantity: 1"
                                    + "</small> "
                                    + "<strong class='d-block text-sm'>" + response.product.price+ "</strong>" +
                                "</div></div></div></div>"
                    );
                $('.cart-qty').html(response.cart.totalQty);
                $('.cart-price').html(response.cart.totalPrice);
                addDeleteListener();
            },
        });
    });
    addDeleteListener();

    $(".js-range-slider").ionRangeSlider(
    {
        type: "double",
        grid: true,
        min: 0,
        max: 50000000,
        from: 200,
        to: 10000000,
        prefix: "VND",
    });

    $('.btn-quantity-sub').on('click', function(){
        var itemslug = $(this).attr('data-slug');
        var itemId = $(this).attr('data-id');
        var url = "/cart/decrease/" + itemslug;
        var inputQty = $('#item-' + itemslug).val();
        if (inputQty != 0) {
            inputQty--;
            $('#item-' + itemslug).val(inputQty);
        }

        $.ajax(
        {
            url: url,
            method: 'get',
            data: 'itemslug',
            success: function(response)
            {
                appendDataCart(response, itemId, itemslug, inputQty);
            },
        });
    });

    $('.btn-quantity-plus').on('click', function(){
        var itemslug = $(this).attr('data-slug');
        var itemId = $(this).attr('data-id');
        var url = "/cart/increase/" + itemslug;
        var inputQty = $('#item-' + itemslug).val();
        inputQty++;
        $('#item-' + itemslug).val(inputQty);

        $.ajax(
        {
            url: url,
            method: 'get',
            data: 'itemslug',
            success: function(response)
            {
                appendDataCart(response, itemId, itemslug, inputQty);
            },
        });
    });

    $('.dataTable').DataTable({
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]]
    });
});
