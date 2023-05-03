@foreach ($products as $product)
    <div class="col-12 col-md-3 mb-3">
        <div class="card h-100">
            <a href="{{ route('products.details', $product) }}">
                <img src="{{ $product->image_url }}" class="card-img-top" style="max-height: 228px" alt="{{ $product->name }}">
            </a>
            <div class="card-body">
                <ul class="list-unstyled d-flex justify-content-between">
                    <li>
                        @foreach(range(1, 5) as $i)
                            @if($product->avgRating >= $i)
                                <i class="text-warning fa fa-star"></i>
                            @else
                                <i class="text-muted fa fa-star"></i>
                            @endif
                        @endforeach
                    </li>
                    <li class="text-muted text-right">£{{ $convertMoney($product->price) }}</li>
                </ul>
                <a href="{{ route('products.details', $product) }}"
                   class="h2 text-decoration-none text-dark">{{ $product->name }}</a>
                <p class="card-text">
                    {{ Str::limit($product->description, 100) }}
                </p>
                <p class="text-muted">Reviews ({{ $product->reviews->count() }})</p>
            </div>
        </div>
    </div>
@endforeach
