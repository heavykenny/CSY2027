<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin2 </title>
    @include('admin.layouts.head');
</head>
<body>
<div class="container-scroller">
    @include('admin.layouts.navbar')
    <div class="container-fluid page-body-wrapper">

        @include('admin.layouts.sidebar')

        <!-- partial -->
        @yield('content')
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

@include('admin.layouts.footer')
</body>

</html>
