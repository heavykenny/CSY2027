@extends("blank")

@section('title', 'Home')

@section("content")
    <!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="{{ asset("img/banner_img_01.jpg")}}" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-success">Welcome !</h1>
                                <h2 class="h2 text-success">Shop with <span style="font-weight: bold; font-size: 50px">Confidence</span></h2>
                                <h2 class="h2 text-success">Shop with <span style="font-weight: bold; font-size: 50px">eShop.</span></h2>

                                <h3 class="h2" style="margin-top: 50px">Discover, Shop, and Experience a World of Possibilities at eShop!</h3>
                                <p> Find exclusive deals, explore a wide range of products, and enjoy a seamless
                                    shopping experience. From fashion to electronics, eShop has it all. Start your
                                    online shopping journey today! </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Banner Hero -->
    </div>
    <!-- End Banner Hero -->

    <!-- Start Featured Product -->
    <section class="bg-light">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Featured Product</h1>
                    <p>
                        Unleash Your Style with Our Latest Collection!
                    </p>
                </div>
            </div>
            <div class="row" id="productsRow">
                @include('layouts.partial.product', ['products' => $products])
            </div>
            <div class="row mt-4">
                <div class="col-md-12 text-center">
                    <button id="viewAllBtn" class="btn-lg btn-success" data-url="{{ route('products.loadMore') }}"
                            data-page="{{ $products->currentPage() + 1 }}">View More Products
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- End Featured Product -->

    <script !src="">
        $(document).ready(function () {
            const productUrl = '{{ route('products.loadMore') }}';
            $('#viewAllBtn').on('click', function () {
                let button = $(this);

                button.addClass('disabled').text('Loading...');

                $.ajax({
                    url: productUrl,
                    data: {page: button.data('page')},
                    success: function (data) {
                        $('#productsRow').append(data.html);

                        if (data.nextPage) {
                            button.removeClass('disabled').text('View More Products');
                            button.data('page', button.data('page') + 1);
                        } else {
                            button.remove();
                        }
                    }
                });
            });
        });

    </script>
    <!-- End Script -->
@endsection
