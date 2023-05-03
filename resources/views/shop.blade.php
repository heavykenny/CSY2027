@extends("blank")

@section('title', 'Shop')

@section("content")
    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">

            <div class="col-lg-3">
                <h1 class="h2 pb-4">Categories</h1>
                <ul class="list-unstyled templatemo-accordion">
                    @foreach($categories as $category)
                        <li class="pb-3">
                            <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                                {{ $category->name }}
                                <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-6 pb-4">
                        <div class="d-flex">
                            <select class="form-control">
                                <option>Featured</option>
                                <option>A to Z</option>
                                <option>Item</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">

                    @forelse($products as $product)

                        <div class="col-md-4">
                            <div class="card mb-4 product-wap rounded-0">
                                <div class="card rounded-0">
                                    <img class="card-img rounded-0 img-fluid" style="max-height: 300px"
                                         src="{{ $product->image_url }}">
                                    <div
                                        class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                        <ul class="list-unstyled">

                                            <li><a class="btn btn-success text-white mt-2"
                                                   href="{{ route('products.details', $product) }}"><i
                                                        class="far fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('products.details', $product) }}"
                                       class="h3 text-decoration-none custom-text-bold">{{ $product->name }}</a>
                                    <p class="mb-0 custom-text">{{ $product->description }}</p>
                                    <ul class="list-unstyled d-flex justify-content-between mb-0">
                                        <li>{{ implode("/", $product->sizes) }}</li>
                                    </ul>
                                    <ul class="list-unstyled d-flex justify-content-center mb-1">
                                        <li>
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $product->rating)
                                                    <i class="text-warning fa fa-star"></i>
                                                @else
                                                    <i class="text-muted fa fa-star"></i>
                                                @endif
                                            @endfor
                                        </li>
                                    </ul>
                                    <p class="text-center mb-0">£ {{ $product->price }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        "No products found"
                    @endforelse
                </div>
                <div div="row">
                    <ul class="pagination pagination-lg justify-content-end">
                        <ul class="pagination">
                            <li class="page-item {{ $products->previousPageUrl() ? '' : 'disabled' }}">
                                <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0"
                                   href="{{ $products->previousPageUrl() }}" tabindex="-1">Previous</a>
                            </li>
                            @foreach($products->getUrlRange(1, $products->lastPage()) as $product => $url)

                                <li class="page-item {{ $products->currentPage() == $product ? 'active' : '' }}">
                                    <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark"
                                       href="{{ $url }}">{{ $product++ }}</a>
                                </li>
                            @endforeach
                            <li class="page-item {{ $products->nextPageUrl() ? '' : 'disabled' }}">
                                <a class="page-link rounded-0 shadow-sm border-top-0 border-left-0 text-dark"
                                   href="{{ $products->nextPageUrl() }}">Next</a>
                            </li>
                        </ul>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- End Content -->
@endsection
