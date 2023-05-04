@extends("blank")

@section('title', $product->name)

@section("content")

    <!-- Open Content -->
    <section class="bg-light">
        <div class="container pb-5">
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class=" mb-3">
                        <img class="card-img img-fluid" src="{{ $product->image_url }}" alt="Card image cap"
                             id="product-detail">
                    </div>
                </div>
                <!-- col end -->
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="h2">{{ $product->name }}</h1>
                            <p class="h3 py-2">£ {{ $product->price }}</p>
                            <p class="py-2">
                                @foreach(range(1, 5) as $i)
                                    @if($product->avgRating >= $i)
                                        <i class="text-warning fa fa-star"></i>
                                    @else
                                        <i class="text-muted fa fa-star"></i>
                                    @endif
                                @endforeach
                                <span class="list-inline-item text-dark">Rating {{ number_format($product->avgRating, 1) }} | {{ $product->reviews->count() }} Reviews</span>
                            </p>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <h6>Vendor: {{ $product->vendor->name }}</h6>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted"><strong>{{ $product->brand }}</strong></p>
                                </li>
                            </ul>

                            <h6>Description:</h6>
                            <p>{{ $product->description }}</p>

                            <h6>Items in Stock:</h6>
                            <p>{{ $product->quantity }} left</p>


                            <form action="" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item">Size :
                                                <input type="hidden" name="product-size" id="product-size"
                                                       value="{{ $product->sizes[0] }}">
                                            </li>
                                            @foreach($product->sizes as $size)
                                                <li class="list-inline-item">
                                                    <button id="product-size-options" type="button"
                                                            class="btn btn-success btn-size"
                                                            data-size="{{ $size }}"
                                                            onclick="updateHiddenInput('{{ $size }}')">{{ $size }}</button>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item text-right">
                                                Quantity
                                                <input type="hidden" name="product-quantity" id="product-quantity"
                                                       min="0" max="{{ $product->quantity }}"
                                                       value="0">
                                            </li>
                                            <li class="list-inline-item">
                                                <button type="button" class="btn btn-success" id="btn-minus">-</button>
                                            </li>
                                            <li class="list-inline-item"><span class="badge bg-secondary"
                                                                               id="var-value">0</span></li>
                                            <li class="list-inline-item">
                                                <button type="button" class="btn btn-success" id="btn-plus">+</button>
                                                <div class="btn btn-danger"
                                                     style="margin-left: 30px; display: {{ $product->quantity > 0 ? 'none' : '' }}"
                                                     id="btn-out-of-stock">Out Of Stock
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="row pb-3">
                                    @csrf
                                    <div class="col d-grid">
                                        <button type="button" class="btn btn-warning btn-lg"
                                                id="wishlist">
                                            Add to wishlist
                                        </button>
                                    </div>

                                    <div class="col d-grid">
                                        <button id="addToCart" type="button"
                                                {{ $product->quantity > 0 ? '' : 'disabled' }} class="btn btn-info btn-lg">
                                            Add To Cart
                                        </button>
                                    </div>

                                    <div class="col d-grid">
                                        <button id="buyNow" type="button"
                                                {{ $product->quantity > 0 ? '' : 'disabled' }} class="btn btn-success btn-lg"
                                                name="submit">
                                            Buy Now
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row mt-4">
                @if(in_array($product->id, $orderItems) && $canReview)
                    <div class="col-md-6">
                        <h3>Ratings</h3>
                        <div class="my-3">
                            <label for="rating">Your Rating:</label>
                            <select class="form-control" id="rating">
                                <option value="1">1 Star</option>
                                <option value="2">2 Stars</option>
                                <option value="3">3 Stars</option>
                                <option value="4">4 Stars</option>
                                <option value="5">5 Stars</option>
                            </select>
                        </div>

                        <h3>Reviews</h3>
                        <div class="my-3">
                            <label for="review">Your Review:</label>
                            <textarea class="form-control" id="review" rows="3"></textarea>
                        </div>
                        <button class="btn-block btn btn-primary" id="reviewBtn">Submit Review</button>
                    </div>
                @endif
                <div class="col-md-6">
                    <h3>All Reviews</h3>
                    <ul class="list-group" id="reviewList">
                        @forelse($product->reviews as $review)
                            <li class="list-group-item">
                                <strong>Rating:</strong> {{ $review->rating }} stars<br>
                                <strong>Review:</strong> {{ $review->review }} !
                            </li>
                        @empty
                            <p>No reviews yet.</p>
                        @endforelse

                    </ul>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">

        // Update the product quantity
        function updateHiddenInput(s) {
            $('#product-size').val(s);
        }

        $(document).ready(function () {

            // Update the product quantity and set value to 1 when the page loads
            $("#product-quantity").val("1");

            // Update the product quantity
            // this method helps to add product to the wishlist
            $('#wishlist').click(function () {
                let product_id = {{ $product->id }};
                let client_id = {{ Auth::user()->id ?? "0" }};
                let _token = $('input[name="_token"]').val();

                // validate if the user is logged in
                if (client_id == 0) {
                    showAlert('error', 'Please login to add to wishlist');
                } else {
                    // add product to wishlist
                    // send ajax request to the server
                    // to add product to the wishlist
                    $.ajax({
                        url: "{{ route('wishlist.add') }}",
                        type: "POST",
                        data: {
                            product_id: product_id,
                            client_id: client_id,
                            _token: _token
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

            // this method helps to add product to the cart
            // send ajax request to the server to add product to the cart
            $('#addToCart').click(function () {
                let product_id = {{ $product->id }};
                let client_id = {{ Auth::user()->id ?? "0" }};
                let quantity = $('#product-quantity').val();
                let size = $('#product-size').val();
                let _token = $('input[name="_token"]').val();

                // validate if the user is logged in
                if (client_id == 0) {
                    showAlert('error', 'Please login to add product to cart');
                } else {

                    // add product to cart
                    // send ajax request to the server
                    // to add product to the cart
                    $.ajax({
                        url: "{{ route('cart.add') }}",
                        type: "POST",
                        data: {
                            product_id: product_id,
                            client_id: client_id,
                            quantity: quantity,
                            size: size,
                            _token: _token
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

            // this method helps to buy product
            // send ajax request to the server to buy product
            // and redirect to the cart page for user to complete the transaction
            $('#buyNow').click(function () {
                let product_id = {{ $product->id }};
                let client_id = {{ Auth::user()->id ?? "0" }};
                let quantity = $('#product-quantity').val();
                let size = $('#product-size').val();
                let _token = $('input[name="_token"]').val();

                // validate if the user is logged in
                if (client_id == 0) {
                    showAlert('error', 'Please login to before you buy');
                } else {
                    // user buy product
                    // send ajax request to the server
                    $.ajax({
                        url: "{{ route('cart.add') }}",
                        type: "POST",
                        data: {
                            product_id: product_id,
                            client_id: client_id,
                            quantity: quantity,
                            size: size,
                            _token: _token
                        },
                        success: function (response) {
                            if (response) {
                                window.location.href = "{{ route('cart.get') }}";
                            }
                        },
                        error: function (response) {
                            showAlert('error', response.responseJSON.message);
                        }
                    });
                }
            });

            // add reviews to the product
            $('#reviewBtn').click(function () {
                let product_id = {{ $product->id }};
                let client_id = {{ Auth::user()->id ?? "0" }};
                let review = $('#review').val();
                let rating = $('#rating').val();

                let _token = $('input[name="_token"]').val();

                // validate if the user is logged in
                if (client_id == 0) {
                    showAlert('error', 'Please login to add review');
                } else {
                    // add review to the product
                    // send ajax request to the server
                    $.ajax({
                        url: "{{ route('reviews.store') }}",
                        type: "POST",
                        data: {
                            product_id: product_id,
                            client_id: client_id,
                            review: review,
                            rating: rating,
                            _token: _token
                        },
                        success: function (response) {
                            if (response) {
                                showAlert('success', response.message);
                                //reload the page
                                location.reload();
                            }
                        },
                        error: function (response) {
                            showAlert('error', response.responseJSON.message);
                        }
                    });
                }
            });
        });
    </script>
@endsection
