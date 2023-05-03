@extends("blank")

@section('title', 'Cart')

@section("content")
    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">

            <div class="container">
                <h1>Wishlist</h1>

                <div class="row">
                    <div class="col-md-8">
                        <div class="container">

                            @foreach($wishlists as $wishlist)
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div class="row no-gutters">
                                            <div class="col-md-4">
                                                <img src="{{ $wishlist->product->image_url }}" class="card-img"
                                                     alt="Product Image">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="h3 py-2">{{ $wishlist->product->name }}</h5>
                                                    <p class="h3">Vendor: {{ $wishlist->product->vendor->name }}</p>
                                                    <p class="h6">Size: {{ $wishlist->size }}</p>
                                                    <p class="h6 productPrice">Price: £ {{ $wishlist->product->price }}</p>

                                                    <div class="col-auto">
                                                        <ul class="list-inline">
                                                            <input type="hidden"
                                                                   class="cartId"
                                                                   value="{{ $wishlist->id }}">


                                                            <button onclick="moveToCart({{ $wishlist->id }})"
                                                                    style="float: right; margin: 10px" type="button"
                                                                    class="btn-block btn btn-success btn-lg">Move to Cart
                                                            </button>

                                                            <button onclick="removeWishlist({{ $wishlist->id }})"
                                                                    style="float: right; margin: 10px" type="button"
                                                                    class="btn-block btn btn-danger btn-lg">Remove
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
                                <h5 class="card-title">Wishlist Summary</h5>
                                <table class="table">
                                    <tbody>

                                    <tr>
                                        <td class="h2">Total:</td>
                                        <td class="h2" id="total">£0.00</td>
                                    </tr>
                                    </tbody>
                                </table>
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

        function moveToCart(param) {
            $.ajax({
                url: '{{ route('wishlist.move') }}',
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "wishlist_id": param
                },
                success: function (response) {
                    showAlert('success', response.message)

                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                },
                error: function (response) {
                    showAlert('error', response.responseJSON.message)
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                }
            });
        }

        function removeWishlist(param) {
            $.ajax({
                url: '/wishlist/' + param,
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
            function updateWishlistSummary() {
                let subtotal = 0;

                $('.productPrice').each(function () {
                    let price = $(this).text().replace("Price: £", "");

                    subtotal += price * 1;
                });

                let total = subtotal;

                $('#total').text('£ ' + total.toFixed(2));
            }

            updateWishlistSummary();
        });
    </script>

@endsection
