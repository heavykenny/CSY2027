<!DOCTYPE html>
<html lang="en">

<head>
    <title>eShop - About Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include("layouts.header")
</head>

<body>
<!-- Start Top Nav -->
@include("layouts.top-nav")
<!-- Close Top Nav -->


<!-- Header -->
@include("layouts.header-nav")
<!-- Close Header -->

<!-- Modal -->
@include("layouts.modal")
<!-- Close Modal -->

<!-- Start Content -->
@yield("content")
<!-- Start Footer -->
@include("layouts.footer")
<!-- End Footer -->

<!-- Start Script -->
@include("layouts.script")
<!-- End Script -->
</body>

</html>
