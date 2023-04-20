<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register Page</title>
    @include('admin.layouts.head')
</head>

<body>

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="text-center">
                        @include('layouts.error')
                    </div>
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo text-center">
                            <img src="{{ asset("images/logo.svg") }}" alt="logo">
                        </div>
                        <h4 class="text-center">Hello! let's get started</h4>
                        <h6 class="fw-light text-center">Register to continue.</h6>
                        <form method="POST" action="{{ route('register') }}" class="pt-3" autocomplete="off">
                            @csrf
                            <div class="form-group" >
                                <input
                                    id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                                    class="form-control form-control-lg" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                       autofocus
                                       class="form-control form-control-lg" placeholder="User Email">
                            </div>
                            <div class="form-group">
                                <input id="password" type="password" name="password" required
                                       class="form-control form-control-lg"
                                       placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input id="password_confirmation" type="password" name="password_confirmation" required
                                       class="form-control form-control-lg"
                                       placeholder="Password Confirmation"
                                >
                            </div>
                            <div class="mt-3 text-center">
                                <input class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                       type="submit" value="SIGN UP">
                            </div>

                            <div class="text-center mt-4 fw-light">
                                Already have an account? <a href="{{ route("login") }}" class="text-primary">Sign In
                                    Here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- main-panel ends -->
</div>
</body>

</html>
