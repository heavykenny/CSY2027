@extends('admin.layouts.admin')

@section('title', 'Home')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab"
                                   href="#overview" role="tab" aria-controls="overview"
                                   aria-selected="true">Overview</a>
                            </li>

                        </ul>
                        <div>
                            <div class="btn-wrapper">
                                <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                                <a href="#" class="btn btn-primary text-white me-0"><i
                                        class="icon-download"></i> Export</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content tab-content-basic">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel"
                             aria-labelledby="overview">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div
                                        class="statistics-details d-flex align-items-center justify-content-between">
                                        <div>
                                            <p class="statistics-title">Total Products</p>
                                            <h3 class="rate-percentage">{{ $totalProducts }}</h3>
                                        </div>
                                        <div>
                                            <p class="statistics-title">Total Orders</p>
                                            <h3 class="rate-percentage">{{ $totalOrders }}</h3>
                                        </div>
                                        <div>
                                            <p class="statistics-title">Total Vendors</p>
                                            <h3 class="rate-percentage">{{ $totalVendors }}</h3>
                                        </div>
                                        <div>
                                            <p class="statistics-title">Total Sales</p>
                                            <h2 class="me-2 fw-bold">£{{ $convertMoney($totalSales) }}</h2><h4 class="me-2">GBP</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 d-flex flex-column">
                                    <div class="row flex-grow">
                                        <div class="col-12 grid-margin stretch-card">
                                            <div class="card card-rounded">
                                                <div class="card-body">
                                                    <div
                                                        class="d-sm-flex justify-content-between align-items-start">
                                                        <div>
                                                            <h4 class="card-title card-title-dash">Orders Overview</h4>
                                                            <p class="card-subtitle card-subtitle-dash">Last 10 Orders</p>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive  mt-1">
                                                        <table class="table select-table">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">SN</th>
                                                                <th>Order Number</th>
                                                                <th>User Name</th>
                                                                <th>Order Date</th>
                                                                <th>Amount</th>
                                                                <th>Status</th>
                                                                <th>Manage</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            @forelse ($orders as $order)
                                                                <tr>
                                                                    <td colspan="1">{{ $loop->iteration }}</td>
                                                                    <td><h6>{{ $order->order_number }}</h6></td>
                                                                    <td>{{ $order->client->name }}</td>
                                                                    <td>{{ $order->created_at->diffForHumans() }}</td>
                                                                    <td>£ {{ $convertMoney($order->total_amount) }}</td>
                                                                    <td>{{ ucfirst($order->status) }}</td>
                                                                    <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm text-white mb-0 me-0 btn btn-primary">View</a>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="7" class="text-center">No Orders Found</td>
                                                                </tr>
                                                            @endforelse

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
