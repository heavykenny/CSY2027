@extends('admin.layouts.admin')

@section('title', 'Manage Order')

@section('content')

    <div class="container">
        <h1 class="my-5">Order Summary</h1>

        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text">Order Number: {{ $order->order_number }}</p>
                <p class="card-text">Order placed on: {{ $order->created_at->diffForHumans() }}</p>
                <p class="card-text">Status: {{ ucfirst($order->status) }}</p>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Shipping Information</h5>
                <p class="card-text">{{ $order->client->name }}</p>
                <p class="card-text">{{ $order->client->country }}, {{ $order->client->address }}
                    , {{ $order->client->postcode }}</p>
                <p class="card-text">Email: {{ $order->client->email }}</p>
                <p class="card-text">Phone: {{ $order->client->phone }}</p>
            </div>
        </div>

        <div class="card mb-3">
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
                            <td>{{ $item->product->name }}</td>
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

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Order Management</h5>
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="status">Change Status</label>
                        <select class="form-control" name="status">
                            <option value="cancel">Cancel</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="shipped">Shipped</option>
                            <option value="delivered">Delivered</option>
                        </select>
                    </div>

                    <button class="btn btn-primary">Submit</button>
                    <a href="#" class="btn btn-secondary">Go Back</a>
                </form>
            </div>

        </div>

    </div>
@endsection
