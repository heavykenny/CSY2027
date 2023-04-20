<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::all();

        return view('order_items.index', compact('orderItems'));
    }

    public function create()
    {
        return view('order_items.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $orderItem = OrderItem::create($validatedData);

        return redirect()->route('order_items.show', $orderItem);
    }

    public function show(OrderItem $orderItem)
    {
        $orderItem->load('product', 'order.client', 'order.vendor');

        return view('order_items.show', compact('orderItem'));
    }

    public function edit(OrderItem $orderItem)
    {
        return view('order_items.edit', compact('orderItem'));
    }

    public function update(Request $request, OrderItem $orderItem)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $orderItem->update($validatedData);

        return redirect()->route('order_items.show', $orderItem);
    }

    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();

        return redirect()->route('order_items.index');
    }
}
