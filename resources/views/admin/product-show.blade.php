@extends('admin.layouts.admin')

@section('title', 'Product')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-8">
                    <h1>{{ $product->name }}'s Information</h1>
                    <p><strong>Description:</strong> {{ $product->description }}</p>
                    <p><strong>Price:</strong>£ {{ $product->price }}</p>
                    <p><strong>Image URL:</strong> {{ $product->image_url }}</p>
                    <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
                    <p><strong>Category:</strong> {{ $product->category->name }}</p>
                    <p><strong>Average Rating:</strong> {{ number_format($product->avgRating, 1) }}/5</p>
                    <p><strong>Created At:</strong> {{ $product->created_at }}</p>
                    <a href="{{ route('products.index') }}" class="btn btn-warning">Back</a>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        @include('admin.layouts.inner-footer')
        <!-- partial -->
    </div>
@endsection
