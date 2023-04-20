@extends('admin.layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Products</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Image URL</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->image_url }}</td>
                                    <td>
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-primary">View</a>
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-secondary">Edit</a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline-block;">
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
        </div>
    </div>
@endsection
