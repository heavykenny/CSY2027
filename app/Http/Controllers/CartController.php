<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function getAllCarts(Request $request)
    {

        $client_id = auth()->user()->id;

        $carts = Cart::where('client_id', $client_id)->get();
        session()->put('cartCount', $carts->count());

        if ($carts->count() == 0) {
            return redirect()->back()->with('error', 'Your cart is empty');
        }

        return view('cart', compact('carts'));
    }

    public function addToCart(Request $request): JsonResponse
    {
        $request->validate([
            'client_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'size' => 'required',
        ]);

        $exist = Cart::where('client_id', $request->client_id)->where('product_id', $request->product_id)->where('size', $request->size)->first();

        if ($exist) {
            $exist->quantity += $request->quantity;
            $exist->save();

            return response()->json([
                'message' => "Product quantity updated successfully",
            ]);
        }

        $cart = Cart::create([
            'client_id' => $request->client_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'size' => $request->size,
        ]);

        $cartCount = Cart::where('client_id', $request->client_id)->count();
        session()->put('cartCount', $cartCount);

        return response()->json([
            'message' => 'Product added to cart successfully',
            'cart' => $cart,
        ]);
    }

    public function removeFromCart(Request $request, $id): JsonResponse
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json([
                'message' => 'Cart item not found',
            ], 404);
        }

        $cart->delete();

        $cartCount = Cart::where('client_id', $request->client_id)->count();
        session()->put('cartCount', $cartCount);

        return response()->json([
            'message' => 'Product removed from cart successfully',
        ]);
    }

    public function checkout(Request $request): View|Application
    {
        $client_id = auth()->user()->id;

        $carts = Cart::where('client_id', $client_id)->get();

        $total_amount = $carts->sum(function ($cart) {
            $cart->product->quantity -= $cart->quantity;
            $cart->product->save();
            return $cart->product->price * $cart->quantity;
        });

        $order = Order::create([
            'client_id' => $client_id,
            'total_amount' => $total_amount,
            'status' => 'pending',
            'order_number' => 'ORD-ESH-' . rand(0000, 9999),
            'payment_status' => 'pending',
        ]);

        foreach ($carts as $cart) {
            $order->items()->create([
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'size' => $cart->size,
            ]);
        }

        $carts->each->delete();
        session()->put('cartCount', 0);

        return view('checkout', compact('order'));
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'cart_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $exist = Cart::findOrFail($request->cart_id);

        if ($exist) {
            $exist->quantity = $request->quantity;
            $exist->save();

            return response()->json([
                'message' => "Product quantity updated successfully",
            ]);
        }
    }


    public function confirmation($orderNumber)
    {
        $order = Order::findOrFail($orderNumber);

        $order->update([
            'status' => 'confirmed',
        ]);


        return view('confirmation', compact('order'));
    }

}
