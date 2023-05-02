@extends("blank")

@section('title', 'Cart')

@section("content")
    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">

            <div class="container">
                <h1>Cart</h1>

                <div class="row">
                    <div class="col-md-8">
                        <div class="container">

                            @foreach($carts as $cart)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row no-gutters">
                                            <div class="col-md-4">
                                                <img src="{{ $cart->product->image_url }}" class="card-img"
                                                     alt="Product Image">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="h3 py-2">{{ $cart->product->name }}</h5>
                                                    <p class="h3">Vendor: {{ $cart->product->vendor->name }}</p>
                                                    <p class="h6">Size: {{ $cart->size }}</p>
                                                    <p class="h6 productPrice">Price: £ {{ $cart->product->price }}</p>

                                                    <div class="col-auto">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item text-right">
                                                                Quantity
                                                                <input type="hidden" name="product-quantity"
                                                                       id="product-quantity"
                                                                       min="0" max="{{ $cart->product->quantity }}"
                                                                       value="{{ $cart->quantity }}">
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <button type="button" class="btn btn-success"
                                                                        id="product-btn-minus">-
                                                                </button>
                                                            </li>
                                                            <li class="productQuantity list-inline-item"><span
                                                                    class="badge bg-secondary"
                                                                    id="var-value">{{ $cart->quantity }}</span>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <button type="button" class="btn btn-success"
                                                                        id="product-btn-plus">
                                                                    +
                                                                </button>
                                                            </li>

                                                            <input type="hidden"
                                                                   class="cartId"
                                                                   value="{{ $cart->id }}">

                                                            <button onclick="removeCart({{ $cart->id }})"
                                                                    style="float: right" type="button"
                                                                    class="btn btn-danger btn-lg">Remove
                                                            </button>

                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Cart Summary</h5>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td>Subtotal:</td>
                                        <td id="subtotal">£0.00</td>
                                    </tr>
                                    <tr>
                                        <td>Tax:</td>
                                        <td id="tax">£0.00</td>
                                    </tr>
                                    <tr>
                                        <td class="h2">Total:</td>
                                        <td class="h2" id="total">£0.00</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <a href="{{ route('checkout.get') }}" class="btn btn-primary btn-block">Checkout</a>
                                <a href="{{ route('shop') }}" class="btn btn-warning btn-block">Continue
                                    Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- End Content -->
@endsection
@section('scripts')

    <script>
        function removeCart(param) {
            $.ajax({
                url: '/cart/' + param,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (response) {
                    showAlert('success', response.message)

                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                }
            });
        }

        $(document).ready(function () {
            function updateCartSummary() {
                let subtotal = 0;

                $('.productPrice').each(function () {
                    let price = $(this).text().replace("Price: £", "");
                    let quantity = parseFloat($(this).closest('.card-body').find('.productQuantity').text());

                    subtotal += price * quantity;
                });

                let taxRate = 0.1; // 10% tax rate
                let tax = subtotal * taxRate;
                let total = subtotal + tax;

                $('#subtotal').text('£ ' + subtotal.toFixed(2));
                $('#tax').text('£ ' + tax.toFixed(2));
                $('#total').text('£ ' + total.toFixed(2));
            }

            $('.card .list-inline .btn.btn-success').on('click', function () {
                let input = $(this).closest('.list-inline').find('.badge.bg-secondary');
                let value = parseInt(input.text());
                if ($(this).attr('id') === 'product-btn-minus' && value > 0) {
                    input.text(value - 1);
                } else if ($(this).attr('id') === 'product-btn-plus') {

                    let max = "{{ $cart->product->quantity }}";
                    if (value >= max) {
                        showAlert('You cannot add more than ' + max + ' items to the cart.', 'error');
                        return;
                    }
                    input.text(value + 1);
                }

                let quantity = input.text();
                let cart_id = $(this).closest('.card-body').find('.cartId').val();

                updateCart(cart_id, quantity);
                updateCartSummary();
            });

            $('.card .btn.btn-danger.btn-lg').on('click', function () {
                $(this).closest('.card.mb-3').remove();
                updateCartSummary();
            });

            updateCartSummary();


            function updateCart(cart_id, quantity) {

                $.ajax({
                    url: "{{ route('cart.update') }}",
                    type: "POST",
                    data: {
                        cart_id: cart_id,
                        quantity: quantity,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        if (response) {
                            showAlert('success', response.message);
                        }
                    },
                    error: function (response) {
                        showAlert('error', response.responseJSON.message);
                    }
                });

            }
        });
    </script>

@endsection
