<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('meta-fb-share')
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
</head>
<body>
    <div id="app">
        @include('partials.navbar')
        @routes
        @yield('content')
    </div>
    <script src="{{ asset('messages.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    @stack('scripts')
    @if(Auth::check())
        <script type="text/javascript">
            $(document).ready(function () {
                var count = $('.notify-count').html();
                var idOrders = JSON.parse("{{ json_encode($idOrders) }}");
                function addNoti(data) {
                    $('.notify-container').append(
                        "<div class='row notify-color-unread notify-detail'><a class='notify-markSingleRead dropdown-item d-flex align-items-center'><div>"
                        + "<span class='small notify-time'>" + data.order.updated_at + "</span><p class='notify-text font-weight-bold'>"
                        + Lang.get('common.user.order.notify', {id: data.order.id})
                        +"<span class='badge badge-pill " + data.order.status.class +"'>"
                        +  data.order.status.lang + "</span></p></div></a></div>"
                    );
                    count++;
                    $('.notify-count').html(count);
                }
                if (idOrders[0] != 0) {
                    for (var i = 0; i < idOrders.length; i++) {
                        window.Echo.private('order-status.' + idOrders[i])
                        .listen('OrderStatus', (e) => {
                            addNoti(e);
                        });
                    }
                }
            });
        </script>
    @endif
</body>
</html>
