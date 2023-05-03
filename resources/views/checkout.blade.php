@extends("blank")

@section('title', 'Cart')

@section("content")
    <!-- Start Content -->
    <div class="container py-2">
        <div class="container">
            <h1 class="">Order Payment - #{{ $order->order_number }}</h1>
            <div class="row">
                <div class="container">
                    <div class="row">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Vendor</th>
                                <th scope="col">Size</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->product->vendor->name }}</td>
                                    <td>{{ $item->size }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>£ {{ $item->product->price }}</td>
                                    <td>£ {{ $item->product->price * $item->quantity }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row mt-2">
                <p class="">Please enter your payment information below.</p>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Payment Information</h5>
                            <form>
                                <div class="form-group">
                                    <label for="cardNumber">Card Number</label>
                                    <input type="text" class="form-control" id="cardNumber">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="expiryDate">Expiry Date</label>
                                        <input type="text" class="form-control" id="expiryDate">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="cvv">CVV</label>
                                        <input type="text" class="form-control" id="cvv">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Payment Method</h5>
                            <div class="form-group">
                                <div class="m-3 custom-control custom-radio">
                                    <input type="radio" id="creditCard" name="paymentMethod"
                                           class="custom-control-input" checked>
                                    <label class="custom-control-label" for="creditCard">Credit Card</label>
                                </div>
                                <div class="m-3 custom-control custom-radio">
                                    <input type="radio" id="paypal" name="paymentMethod" class="custom-control-input">
                                    <label class="custom-control-label" for="paypal">PayPal</label>
                                </div>
                                <div class="m-3 custom-control custom-radio">
                                    <input type="radio" id="bankTransfer" name="paymentMethod"
                                           class="custom-control-input">
                                    <label class="custom-control-label" for="bankTransfer">Bank Transfer</label>
                                </div>
                            </div>
                            <div class="form-group m-3">
                                <label for="paymentAmount">Payment Amount</label>
                                <input type="text" class="m-2 p-3 form-control" id="paymentAmount"
                                       value="£ {{ $convertMoney($order->total_amount) ?? 0 }}" readonly>
                            </div>

                            <a href="{{ route('checkout.confirmation', $order->id) }}" class="btn btn-primary">Make Payment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
@endsection
