@extends('admin.layouts.admin')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ $product->name }}'s Information</h1>
                    <p><strong>Description:</strong> {{ $product->description }}</p>
                    <p><strong>Price:</strong> {{ $product->price }}</p>
                    <p><strong>Image URL:</strong> {{ $product->image_url }}</p>
                    <p><strong>Average Rating:</strong> {{ number_format($product->avgRating, 1) }}/5</p>
                    <h4>Reviews</h4>
                    @foreach ($reviews as $review)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $review->rating }}/5</h5>
                                <p class="card-text">{{ $review->review }}</p>
                            </div>
                            <div class="card-footer text-muted">
                                {{ $review->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @endforeach
                    <h4>Add a Review</h4>
                    <form action="{{ route('reviews.store', $product) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="rating">Rating (out of 5)</label>
                            <input type="number" name="rating" id="rating" class="form-control" min="1" max="5"
                                   value="{{ old('rating') }}">
                            @error('rating')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="review">Review</label>
                            <textarea name="review" id="review" class="form-control">{{ old('review') }}</textarea>
                            @error('review')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        @include('admin.layouts.inner-footer')
        <!-- partial -->
    </div>
@endsection
