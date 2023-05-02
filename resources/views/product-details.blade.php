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
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript">

        window.onload = function () {
            document.getElementById("product-quantity").value("1");
        };

        function updateHiddenInput(s) {
            $('#product-size').val(s);
        }

        $(document).ready(function () {

            $('#wishlist').click(function () {
                let product_id = {{ $product->id }};
                let client_id = {{ Auth::user()->id ?? "0" }};
                let _token = $('input[name="_token"]').val();

                if (client_id == 0) {
                    showAlert('error', 'Please login to add to wishlist');
                } else {
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

            $('#addToCart').click(function () {
                let product_id = {{ $product->id }};
                let client_id = {{ Auth::user()->id ?? "0" }};
                let quantity = $('#product-quantity').val();
                let size = $('#product-size').val();
                let _token = $('input[name="_token"]').val();

                if (client_id == 0) {
                    showAlert('error', 'Please login to add product to wishlist');
                } else {

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

            $('#buyNow').click(function () {
                let product_id = {{ $product->id }};
                let client_id = {{ Auth::user()->id ?? "0" }};
                let quantity = $('#product-quantity').val();
                let size = $('#product-size').val();
                let _token = $('input[name="_token"]').val();

                if (client_id == 0) {
                    showAlert('error', 'Please login to add product to wishlist');
                } else {
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
        });
    </script>
@endsection
