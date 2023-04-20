<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('orders.create');
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
