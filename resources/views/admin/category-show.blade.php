@extends('admin.layouts.admin')

@section('title', 'Category')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ $category->name }} Category</h1>
                    <p><strong>Description:</strong> {{ $category->description }}</p>

                    <div class="form-group">
                        <a href="{{ route('categories.index', $category) }}" class="btn btn-warning">Back to
                            Categories</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        @include('admin.layouts.inner-footer')
        <!-- partial -->
    </div>
@endsection
