@extends("blank")

@section('title', 'User Orders')

@section("content")
    <div class="container">
        <h1 class="my-5">Order Details</h1>

        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text">Order Number: {{ $order->order_number }}</p>
                <p class="card-text">Order placed on: {{ $order->created_at->diffForHumans() }}</p>
                <p class="card-text">Status: {{ $order->status }}</p>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Shipping Information</h5>
                <p class="card-text">{{ $order->client->name }}</p>
                <p class="card-text">{{ $order->client->country }}, {{ $order->client->address }}, {{ $order->client->postcode }}</p>
                <p class="card-text">Email: {{ $order->client->email }}</p>
                <p class="card-text">Phone: {{ $order->client->phone }}</p>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Payment Information</h5>
                <p class="card-text">Payment method: Credit Card</p>
                <p class="card-text">Card Number: **** **** **** 1234</p>
                <p class="card-text">Expiry Date: {{ now()->addDays(5)->diffForHumans() }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Order Items</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Vendor</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->vendor->name }}</td>
                            <td><a href="{{ route("products.details", $item->product) }}">{{ $item->product->name }}</a></td>
                            <td>£ {{ $convertMoney($item->product->price) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>£ {{ $convertMoney($item->product->price * $item->quantity) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="4">Total</th>
                        <th>£ {{ $convertMoney($order->total_amount) }}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection
