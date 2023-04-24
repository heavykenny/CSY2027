@extends('admin.layouts.admin')

@section('title', 'Edit Category')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-8">
                    <h1>Edit {{$category->name}}</h1>
                    <form action="{{ route('categories.update', $category) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control"
                                   value="{{ old('name', $category->name) }}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description"
                                      class="my-textarea">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Update Category</button>
                            <a href="{{ route('categories.index') }}" class="btn btn-warning">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        @include('admin.layouts.inner-footer')
    </div>
@endsection
