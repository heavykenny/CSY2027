@extends('admin.layouts.admin')

@section('title', 'All Orders')

@section('content')

    <div class="content-wrapper">

        <div class="col-sm-8">
            <h1>All Orders</h1>
            <table class="table">
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
                @foreach ($orders as $order)
                    <tr>
                        <td colspan="1">{{ $orders->firstItem() + $loop->iteration - 1 }}</td>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->client->name }}</td>
                        <td>{{ $order->created_at->diffForHumans() }}</td>
                        <td>£ {{ $convertMoney($order->total_amount) }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-primary">View</a>
                    </tr>
                @endforeach
                </tbody>
            </table>

                {{ $orders->links() }}
        </div>

    </div>
@endsection
