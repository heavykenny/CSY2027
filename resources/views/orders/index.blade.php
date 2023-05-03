@extends("blank")

@section('title', 'User Orders')

@section("content")

    <div class="container">
        <h1 class="my-5">All Orders</h1>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">SN</th>
                <th>Order Number</th>
                <th>Order Date</th>
                <th>Amount</th>
                <th>Status</th>
                <th>View Details</th>
            </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
                <tr>
                    <th>{{ $orders->firstItem() + $loop->iteration - 1 }}</th>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->created_at->diffForHumans() }}</td>
                    <td>£ {{ $convertMoney($order->total_amount) }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">View</a>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="6" class="text-center">No orders found.</td>
                </tr>
            @endforelse
            </tbody>

        </table>
        <div div="row">

            <ul class="pagination pagination-lg justify-content-end">
                <ul class="pagination">
                    <li class="page-item {{ $orders->previousPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0"
                           href="{{ $orders->previousPageUrl() }}" tabindex="-1">Previous</a>
                    </li>
                    @foreach($orders->getUrlRange(1, $orders->lastPage()) as $order => $url)

                        <li class="page-item {{ $orders->currentPage() == $order ? 'active' : '' }}">
                            <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark"
                               href="{{ $url }}">{{ $order++ }}</a>
                        </li>
                    @endforeach
                    <li class="page-item {{ $orders->nextPageUrl() ? '' : 'disabled' }}">
                        <a class="page-link rounded-0 shadow-sm border-top-0 border-left-0 text-dark"
                           href="{{ $orders->nextPageUrl() }}">Next</a>
                    </li>
                </ul>
            </ul>
        </div>
    </div>
@endsection
