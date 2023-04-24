@extends('admin.layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Edit {{$product->name}}</h1>
                    <form action="{{ route('products.update', $product) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                   value="{{ old('name', $product->name) }}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description"
                                      class="my-textarea">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" class="form-control"
                                   value="{{ old('price', $product->price) }}">
                            @error('price')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image_url">Image URL</label>
                            <input type="text" name="image_url" id="image_url" class="form-control"
                                   value="{{ old('image_url', $product->image_url) }}">
                            @error('image_url')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="{{ route('products.show', $product) }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        @include('admin.layouts.inner-footer')
    </div>
@endsection
