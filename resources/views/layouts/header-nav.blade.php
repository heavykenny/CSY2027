<nav class="navbar navbar-expand-lg navbar-light shadow" style="padding-top: 65px;">
    <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand text-success logo h1 align-self-center" href="{{ route("welcome") }}">
            eShop
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between"
             id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("welcome") }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("about") }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("shop") }}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route("contact") }}">Contact</a>
                    </li>
                </ul>
            </div>
            <div class="navbar align-self-center d-flex">
                <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                        <div class="input-group-text">
                            <i class="fa fa-fw fa-search"></i>
                        </div>
                    </div>
                </div>
                <a class="nav-icon d-none d-lg-inline" href="#" data-bs-toggle="modal"
                   data-bs-target="#templatemo_search">
                    <i class="fa fa-fw fa-search text-dark mr-2"></i>
                </a>
                <a class="nav-icon position-relative text-decoration-none" href="{{ route('cart.get') }}">
                    <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>

                    @php
                        $cartCount = 0;
                        $wishlistCount = 0;
                        if (session()->has('cartCount')) {
                            $cartCount = session()->get('cartCount');
                        }

                        if (session()->has('wishlistCount')) {
                            $wishlistCount = session()->get('wishlistCount');
                        }
                    @endphp
                    <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">{{ $cartCount }}</span>
                </a>
                <a class="nav-icon position-relative text-decoration-none" href="{{ route("profile.index") }}">
                    <i class="fa fa-fw fa-user text-dark mr-3"></i>
                    <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                </a>

                <a class="nav-icon position-relative text-decoration-none" href="{{ route("orders.index") }}">
                    <i class="fa fa-fw fa-shopping-bag text-dark mr-3"></i>
                    <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                </a>

                <a class="nav-icon position-relative text-decoration-none" href="{{ route("wishlist.get") }}">
                    <i class="fa fa-fw fa-heart text-dark mr-3"></i>
                    <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark">{{ $wishlistCount }}</span>
                    <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark"></span>
                </a>
            </div>
        </div>

    </div>
</nav>
