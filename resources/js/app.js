
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('./clean-blog.js')
require('./logout.js')

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
                console.log(response);
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
            },
        });
    });
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
                                    "<small class='d-block text-muted'>Quantity: 1"
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
    addDeleteListener ()
});
