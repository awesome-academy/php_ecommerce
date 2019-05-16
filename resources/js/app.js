
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 require('./clean-blog.js')
 require('./logout.js')
 require('./subiz-chat.js')
 require('./jquery.rating.js')
 require('./facebook-share.js')

 function addDeleteListener () {
    $('.remove-item-cart').on('click', function () {
        var productSlug = $(this).attr('data-slug');
        var url = route('cart.destroy', productSlug);
        var parent = $(this).parents();
        $.ajax(
        {
            url: url,
            data: productSlug,
            method: 'delete',
            success: function (response)
            {
                displayMessage(response);
                $('div.divider-add').remove();
                parent[2].remove();
                $('.cart-qty').html(response.cart.totalQty);
                $('.cart-price').html(response.cart.totalPrice);
                $('.total-items-qty').html("Total " + response.cart.totalQty + " item(s)");
                $('.dropdown-cart-nav').addClass('show');
                $('.dropdown-menu-nav').addClass('show');
            },
        });
    });
}

function addProductToCart() {
    $('.add-product').on('click', function () {
        var qty = $(this).attr('data-qty');
        if (qty > 0)
        {
            var productSlug = $(this).attr('data-slug');
            var url = route('cart.store', productSlug);
            var itemId = "id='cart-item-'";
            $.ajax(
            {
                url: url,
                method: 'post',
                data: productSlug,
                success: function (response)
                {
                    displayMessage(response);
                    if($('#cart-item-qty-' + response.product.id).length != 0)
                    {
                        $('#cart-item-qty-' + response.product.id).html(
                            Lang.get('common.text.nav.quantity',
                            {qty: response.cart.items[response.product.id].qty})
                        );
                        $('.cart-qty').html(response.cart.totalQty);
                        $('.cart-price').html(response.cart.totalPrice);
                        $('.dropdown-cart-nav').addClass('show');
                        $('.dropdown-menu-nav').addClass('show');
                    }
                    else
                    {
                        $('.cart-item-container').append(
                            "<div class='dropdown-divider divider-add'></div>" +
                            "<div class='navbar-cart-product'>" +
                            "<div class='d-flex align-items-center'>" +
                            "<a href='#'><img class='navbar-cart-product-image' " +
                            "src='../" + response.product.image + ".jpg'" + "></a> " +
                            "<div class='w-100'> " +
                            "<a class='close text-sm mr-2 remove-item-cart' data-slug='"
                            + response.product.slug + "'> " +
                            "<i class='fa fa-times'></i></a> " +
                            "<div class='pl-3'> " +
                            "<h6 class='navbar-cart-product-link'> "
                            + response.product.name + "</h6>" +
                            "<small id='cart-item-qty-" + response.product.id +
                            "' class='d-block text-muted'>" + Lang.get('common.text.nav.quantity',
                             {qty: response.cart.items[response.product.id].qty})
                            + "</small> "
                            + "<strong class='d-block text-sm'>" + response.product.price+ "</strong>" +
                            "</div></div></div></div>"
                            );
                        $('.cart-qty').html(response.cart.totalQty);
                        $('.cart-price').html(response.cart.totalPrice);
                        $('.dropdown-cart-nav').addClass('show');
                        $('.dropdown-menu-nav').addClass('show');
                        addDeleteListener();
                    }
                },
            });
        }
    });
}

function appendDataCart (response, itemId, itemslug, inputQty) {
    $('.cart-qty').html(response.cart.totalQty);
    $('.cart-price').html(response.cart.totalPrice);
    $('.total-items-qty').html("Total " + response.cart.totalQty + " item(s)");
    $('#cart-item-qty-' + itemId).html("Quantity: " + inputQty);
    $('#price-product-' + itemslug).html(response.cart.items[itemId].price);
}

function displayMessage(response) {
    $('.alert').addClass('alert-' + response.level);
    $('.alert').css('display', 'none');
    $('.alert-text').html(response.message);
    $('.alert').fadeIn(2000);

    setTimeout(function () {
        $('.alert').fadeOut(1000);
    }, 3000);
}

function appendDataFilter(response, i) {
    var checkDisabilityBtn = response.products[i].stock_quantity > 0 ? "" : "disabled";
    $('.products-container').append(
        "<div class='col-lg-4 col-md-6 mb-4'><div class='card h-100'>" +
        "<a href='" + route('shop.show', {productSlug: response.products[i].slug}) + "'>" +
        "<img class='card-img-top'" + "src='" + response.products[i].image + ".jpg'></a>" +
        "<div class='card-body'><h4 class='card-title'>" +
        "<a href='" + route('shop.show', {productSlug: response.products[i].slug}) +"'>" +
        response.products[i].name + "</a></h4><h5>" +
        response.products[i].price + "</h5>" +
        "<p class='card-text'>" + response.products[i].description +"</p></div>"+
        "<div class='card-footer'>" +
        "<button type='button' data-qty='" + response.products[i].stock_quantity + "' " +
        "data-slug='"+ response.products[i].slug +"' " +
        "class='add-product btn btn-outline-primary float-right " + checkDisabilityBtn + "'>"
        + Lang.get('common.text.shop_page.buy') +"</button></div></div></div>"
        );
}


$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".display-item").rateBar({
        defaultStarColor : '#777777',
        ratedStarColor : '#FFD700',
        onRate : function(rate) {
            $('#num-rating').val(rate);
        }
    });

    addProductToCart();
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

    $('.filter-price-btn').on('click', function() {
        var dataFilter = $('.js-range-slider').prop('value');
        var url = route('shop.filter.price', dataFilter);
        $.ajax(
        {
            url: url,
            method: 'get',
            data: dataFilter,
            success: function(response)
            {
                $('.pagination').css('display', 'none');
                $('.products-container').empty();
                for (var i = 0; i < response.products.length; i++) {
                    appendDataFilter(response, i);
                }
                addProductToCart();
            }
        });
    });

    $('.filter-cat-btn').on('click', function() {
        var itemslug = $(this).attr('data-slug');
        var url = route('shop.filter.category', itemslug);
        $.ajax(
        {
            url: url,
            method: 'get',
            data: itemslug,
            success: function(response)
            {
                $('.pagination').css('display', 'none');
                $('.products-container').empty();
                for (var i = 0; i < response.products.length; i++) {
                    appendDataFilter(response, i);
                }
                addProductToCart();
            }
        });
    });

    $('.btn-quantity-sub').on('click', function(){
        var itemslug = $(this).attr('data-slug');
        var itemId = $(this).attr('data-id');
        var url = route('cart.decrease', itemslug);
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
        var url = route('cart.increase', itemslug);
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

    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
    });

    $('.delete-order').on('click', function () {
        var id = $(this).data("id");
        var parent = $(this).parent();
        $.ajax(
        {
            url: route('orders.destroy', id),
            method: 'delete',
            data: {
                id: id,
            },
            dataType: 'json',
            success: function (response)
            {
                displayMessage(response);

                parent.slideUp(300, function () {
                    parent.closest("tr").remove();
                });
            }

        });
    });

    $('.delete-product').on('click', function () {
        var id = $(this).data("id");
        var parent = $(this).parent();
        $.ajax(
        {
            url: route('products.destroy', id),
            method: 'delete',
            data: {
                id: id,
            },
            dataType: 'json',
            success: function (response)
            {
                displayMessage(response);

                parent.slideUp(300, function () {
                    parent.closest("tr").remove();
                });
            }
        });
    });

    $('.detail-order').on('click', function () {
        $("#detailModal").find('.modal-body #detail-order-table tbody').empty();
        var id = $(this).data("id");
        $.ajax(
        {
            url: route('user.detail', id),
            method: 'get',
            data: {
                id: id,
            },
            dataType: 'json',
            success: function (response)
            {
                for(var i = 0; i < response.order.length; i++)
                {
                    $("#detailModal").find('.modal-body #detail-order-table tbody').append(
                        "<tr><td><img class='img-fluid admin-product-img' src='../"
                        + response.order[i].image +".jpg'></td>"
                        + "<td>" + response.order[i].name +"</td>"
                        + "<td>" + response.order[i].pivot.quantity + "</td>"
                        + "<td>" + response.order[i].pivot.price + "</td></tr>"
                    );
                }
            }
        });
    });

    $('.notify-markAllRead').on('click', function (e) {
        e.preventDefault();
        $.ajax(
        {
            url: route('notifications.marks'),
            method: 'get',
            success: function (response)
            {
                $('.notify-count').html(0);
                $('.notify-detail').removeClass('notify-color-unread');
            },
        });
    });

    $('.notify-markSingleRead').on('click', function () {
        var id = $(this).data('id');
        var count = $('.notify-count').html();
        $.ajax(
        {
            url: route('notifications.mark.single', id),
            method: 'get',
            data: {
                id: id,
            },
            dataType: 'json',
            success: function (response)
            {
                if(count > 0)
                {
                    count--;
                }
                $('#noti-' + id).off('click');
                $('.notify-count').html(count);
                $('.' + id).removeClass('notify-color-unread');
            },
        });
    });

    $('.notify-removeAll').on('click', function (e) {
        e.preventDefault();
        $.ajax(
        {
            url: route('notifications.remove'),
            method: 'delete',
            success: function (response)
            {
                $('.notify-container').empty()
                $('.notify-count').html(0);
            },
        });
    });
});
