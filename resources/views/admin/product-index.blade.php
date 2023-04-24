@extends('admin.layouts.admin')

@section('title', 'All Products')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <h1>All Products</h1>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price (£)</th>
                            <th>Quantity</th>
                            <th>Category</th>
                            <th>Image URL</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ str()->limit($product->description, 10) }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ str()->limit($product->image_url, 10) }}</td>
                                <td>
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-primary">View</a>
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                          style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('products.create') }}" class="btn btn-success">Add Product</a>


                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        @include('admin.layouts.inner-footer')
    </div>
@endsection
