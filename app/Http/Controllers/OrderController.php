<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function userOrderIndex(Request $request)
    {
        // order by created_at desc to show the latest order first
        // paginate the orders to show 10 orders per page
        // load the client and vendor relationship
        // return the view with the orders

        $orders = Order::where('client_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function adminOrderIndex()
    {
        // order by created_at desc to show the latest order first
        // paginate the orders to show 10 orders per page
        // load the client and vendor relationship
        // return the view with the orders

        $orders = Order::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.order-index', compact('orders'));
    }

    public function adminOrderShow(Order $order)
    {
        $order->load('client', 'vendor', 'items.product');
        return view('admin.order-details', compact('order'));
    }

    public function adminOrderUpdate(Order $order, Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|string',
        ]);


        $order->update($validatedData);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Order status updated successfully');
    }

    public function userOrderShow(Order $order)
    {
        $order->load('client', 'vendor', 'items.product');
        return view('orders.order_summary', compact('order'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|integer',
            'vendor_id' => 'required|integer',
            'status' => 'required|string',
            'total_amount' => 'required|numeric',
        ]);

        $order = Order::create($validatedData);

        return redirect()->route('orders.show', $order);
    }

    public function create()
    {
        return view('orders.create');
    }

    public function show(Order $order)
    {
        $order->load('client', 'vendor', 'items.product');

        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|integer',
            'vendor_id' => 'required|integer',
            'status' => 'required|string',
            'total_amount' => 'required|numeric',
        ]);

        $order->update($validatedData);

        return redirect()->route('orders.show', $order);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index');
    }
}
