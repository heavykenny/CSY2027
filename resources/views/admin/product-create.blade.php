@extends('admin.layouts.admin')

@section('title', 'Create Product')

@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-8">
                <h1>Create Product</h1>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description"
                                  class="my-textarea" rows="5">{{ old('description') }}</textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control" step="0.01"
                               value="{{ old('price') }}">
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control"
                               value="{{ old('quantity') }}">
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
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-muted">You can create a new <a href="{{ route('categories.create') }}">category
                                here</a></p>
                    </div>

                    <div class="form-group">
                        <label for="vendor_id">Vendor</label>
                        @error('vendor_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <select name="vendor_id" id="vendor_id" class="form-control">
                            <option value="{{ old('vendor_id') }}">-- Select a vendor --</option>
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control-file">
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Create Product</button>
                        <a href="{{ route('products.index') }}" class="btn btn-warning">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

