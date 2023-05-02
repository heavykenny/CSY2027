@extends("blank")

@section('title', 'Order Confirmation')

@section("content")
    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">
            <div class="container">
                <div class="text-center mt-5">
                    <h1>Order Confirmation</h1>
                    <p>Your order has been successfully placed!</p>
                </div>

                <div class="row mt-5">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Order Summary</h5>
                                <p class="card-text">Order #{{ $order->order_number }}</p>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>£ {{ $item->product->price }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="text-right">
                                    <h5>Total: £ {{ $order->total_amount }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <p>Thank you for your order. We will process it soon and provide further updates.</p>
                    <a href="{{ route('welcome') }}" class="btn btn-primary">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
@endsection
