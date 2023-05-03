<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="{{ route("admin.home") }}">
                <img src="{{ asset("images/logo.svg") }}" alt="logo"/>
            </a>
            <a class="navbar-brand brand-logo-mini" href="{{ route("admin.home") }}">
                <img src="{{ asset("images/logo.svg") }}" alt="logo"/>
            </a>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">

                @php
                    $currentTime = date("H");
                    $greeting = "";
                    if ($currentTime < 12) {
                        $greeting = "Good Morning";
                    } else if ($currentTime < 18) {
                        $greeting = "Good Afternoon";
                    } else {
                        $greeting = "Good Evening";
                    }
                @endphp
                <h1 class="welcome-text">{{ $greeting }}, <span
                        class="text-black fw-bold">{{ auth()->user()->name }}</span></h1>
                <h3 class="welcome-sub-text">Your administration dashboard </h3>

                @if(auth()->user()->vendor)
                    <h3 style="margin-bottom: 10px; " class="welcome-sub-text text-black">You belong to
                        Vendor: {{ auth()->user()->vendor->name }}</h3>
                @endif
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <a href="{{ route("welcome") }}" class="btn btn-success btn-sm text-white mb-0 me-0" type="button">
                View Homepage</a>
            <li class="nav-item">
                <form class="search-form" action="#">
                    <i class="icon-search"></i>
                    <input type="search" class="form-control" placeholder="Search Here" title="Search here">
                </form>
            </li>

            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" src="{{ asset("images/faces/face8.jpg") }}" alt="Profile image">
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" src="{{ asset("images/faces/face8.jpg") }}"
                             alt="Profile image">
                        <p class="mb-1 mt-3 font-weight-semibold">{{ auth()->user()->name }}</p>
                        <p class="fw-light text-muted mb-0">{{ auth()->user()->email }}</p>
                    </div>
                    <a href="{{ route("profile.index") }}" class="dropdown-item"><i
                            class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile
                        </a>
                    <a href="{{ route("logout") }}" class="dropdown-item"><i
                            class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign
                        Out</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
