@component('mail::message')
# Order Detail

You have new order!!

Order ID : {{ $order->id }}

Total price: {{ $order->total_price }}

Order Date: {{ $order->created_at }}
@component('mail::table')

|Product|Quantity|Price|
| ------------- |:-------------:| --------:|
@foreach($order->products as $product)
|{{ $product->name }}|{{ $product->pivot->quantity }}|{{ $product->pivot->price }}|
@endforeach
@endcomponent

@component('mail::button', ['url' => $url])
View order
@endcomponent

Thanks,<br>
Admin T.E-Shopping
@endcomponent
