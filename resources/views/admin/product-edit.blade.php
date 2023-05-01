@extends('admin.layouts.admin')

@section('title', 'Edit Product')

@section('content')

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
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control"
                               value="{{ old('quantity', $product->quantity) }}">
                        @error('quantity')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sizes">Sizes</label>
                        <input type="text" class="form-control @error('sizes') is-invalid @enderror"
                               id="sizes" name="sizes"
                               value="{{ old('sizes', ($product->sizes ?? []) ? implode(',', $product->sizes) : '') }}"
                               placeholder="Enter sizes (comma-separated)">
                        @error('sizes')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_id">Categories</label>
                        @error('category_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="{{ old('category_id') }}">-- Select a Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        @if($category->id == old('category_id', $product->category_id)) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="vendor_id">Vendor</label>
                        @error('vendor_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <select name="vendor_id" id="vendor_id" class="form-control">
                            <option value="{{ old('vendor_id') }}">-- Select a vendor --</option>
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}"
                                        @if($vendor->id == old('vendor_id', $product->vendor_id)) selected @endif>{{ $vendor->name }}</option>
                            @endforeach
                        </select>
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
@endsection
