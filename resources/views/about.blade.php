@extends("blank")

@section('title', 'About Us')

@section("content")
    <section class="bg-success py-5">
        <div class="container">
            <div class="row align-items-center py-5">
                <div class="col-md-8 text-white">
                    <h1>About Us</h1>
                    <p>
                        Welcome to eShop!
                        <br>
                        <br>
                        We're your go-to online shopping destination, offering a vast selection of products across
                        various categories.
                        <br>
                        <br>
                        Our mission is to provide a seamless shopping experience with user-friendly features, secure
                        transactions, and top-quality merchandise.
                        <br>
                        <br>
                        With our intuitive interface, finding the latest trends and must-have items is a breeze.
                        <br>
                        <br>
                        Trust and privacy are paramount to us, and we prioritize your satisfaction.
                        <br>
                        <br>
                        Our dedicated support team is always here to assist you.
                        <br>
                        <br>
                        Join us and embark on a journey of endless possibilities.
                        <br>
                        <br>
                        Happy shopping with eShop!
                        <br>
                        <br>
                        Thank you for choosing eShop. Happy shopping!.
                    </p>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset("img/about-hero.svg") }}" alt="About Hero">
                </div>
            </div>
        </div>
    </section>
    <!-- Close Banner -->

    <!-- Start Section -->
    <section class="container py-5">
        <div class="row text-center pt-5 pb-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Our Services</h1>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fa fa-truck fa-lg"></i></div>
                    <h2 class="h5 mt-4 text-center">Delivery Services</h2>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fas fa-exchange-alt"></i></div>
                    <h2 class="h5 mt-4 text-center">Shipping & Return</h2>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fa fa-percent"></i></div>
                    <h2 class="h5 mt-4 text-center">Promotion</h2>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fa fa-user"></i></div>
                    <h2 class="h5 mt-4 text-center">24 Hours Service</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->
@endsection
