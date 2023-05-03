<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * This class handles all the cart related functions
 */
class CartController extends Controller
{

    /** This function gets all the items in the cart of the logged in user
     *  and displays them in the cart page
     *
     * @return Factory|View|RedirectResponse|Application
     */
    public function getAllCarts(): Factory|View|RedirectResponse|Application
    {
        // get all the items in the cart of the logged-in user
        $carts = Cart::where('client_id', auth()->user()->id)->get();

        // put the number of items in the cart in the session
        session()->put('cartCount', $carts->count());

        // if the cart is empty, redirect to the shop page with an error message
        if ($carts->count() == 0) {
            return redirect()->route("shop")->with('error', 'Your cart is empty');
        }

        // return the cart view with the cart items
        return view('cart', compact('carts'));
    }

    /**
     * This function adds a product to the cart
     * this function is called via ajax
     * and returns a json response
     *
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function addToCart(Request $request): JsonResponse
    {
        // making use of the laravel validation
        // validate the request for the required fields
        $request->validate([
            'client_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'size' => 'required',
        ]);

        $clientId = $request->client_id;

        // validate the client_id is the same as the logged-in user
        // this is to prevent a user from adding a product to another user's cart
        if ($clientId != auth()->user()->id) {
            return response()->json([
                'message' => 'You are not authorized to add this product to cart',
            ], 401);
        }

        // check if the product already exists in the cart
        // if it exists, update the quantity
        $exist = Cart::where('client_id', $clientId)->where('product_id', $request->product_id)->where('size', $request->size)->first();

        if ($exist) {
            $exist->quantity += $request->quantity;
            $exist->save();

            return response()->json([
                'message' => "Product quantity updated successfully",
            ]);
        }

        // if the product does not exist in the cart, create a new cart item
        $cart = Cart::create([
            'client_id' => $request->client_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'size' => $request->size,
        ]);

        // put the number of items in the cart in the session
        $cartCount = Cart::where('client_id', $request->client_id)->count();
        session()->put('cartCount', $cartCount);

        // return a json response
        return response()->json([
            'message' => 'Product added to cart successfully',
            'cart' => $cart,
        ]);
    }

    /**
     * This function removes a product from the cart
     * this function is called via ajax
     * and returns a json response
     *
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function removeFromCart(Request $request, $id): JsonResponse
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return response()->json([
                'message' => 'Cart item not found',
            ], 404);
        }

        // validate the client_id is the same as the logged-in user
        // this is to prevent a user from removing a product from another user's cart
        if ($cart->client_id != auth()->user()->id) {
            return response()->json([
                'message' => 'You are not authorized to remove this product from cart',
            ], 401);
        }

        // delete the cart item
        $cart->delete();

        // put the number of items in the cart in the session
        $cartCount = Cart::where('client_id', $request->client_id)->count();
        session()->put('cartCount', $cartCount);

        return response()->json([
            'message' => 'Product removed from cart successfully',
        ]);
    }

    /**
     * This function creates a new order for the user
     * and redirects to the checkout page
     * @return Factory|View|RedirectResponse|Application
     */
    public function checkout(): Factory|View|RedirectResponse|Application
    {
        $client_id = auth()->user()->id;

        // validate user has address, postal code, phone number, etc. before checkout
        // if not, redirect to profile page with error message
        // if yes, proceed to checkout

        if (!auth()->user()->address || !auth()->user()->postcode || !auth()->user()->phone) {
            return redirect()->route('profile.index')->with('error', 'Please update your profile with your address before checkout');
        }

        // get all the items in the cart of the logged-in user
        $carts = Cart::where('client_id', $client_id)->get();

        // calculate the total amount of the order
        // by multiplying the price of each product by the quantity
        $total_amount = $carts->sum(function ($cart) {
            $cart->product->quantity -= $cart->quantity;
            $cart->product->save();
            return $cart->product->price * $cart->quantity;
        });

        // create a new order for the user
        $order = Order::create([
            'client_id' => $client_id,
            'total_amount' => $total_amount,
            'status' => 'pending',
            'order_number' => 'ORD-ESH-' . rand(0000, 9999). '-' . rand(0000, 9999),
            'payment_status' => 'pending',
        ]);

        // create a new order item for each cart item
        foreach ($carts as $cart) {
            $order->items()->create([
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'size' => $cart->size,
            ]);
        }

        // delete all the cart items because
        // they have been converted to order items
        $carts->each->delete();

        // put the number of items in the cart in the session
        session()->put('cartCount', 0);

        return view('checkout', compact('order'));
    }

    /**
     * This function updates the quantity of a product in the cart
     * this function is called via ajax
     * and returns a json response
     *
     *
     * @param Request $request
     * @return JsonResponse|void
     */
    public function updateCart(Request $request)
    {
        // validate the request for the required fields
        $request->validate([
            'cart_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $exist = Cart::find($request->cart_id);

        // validate the client_id is the same as the logged-in user
        // this is to prevent a user from updating a product in another user's cart
        if ($exist->client_id != auth()->user()->id) {
            return response()->json([
                'message' => 'You are not authorized to update this product in cart',
            ], 401);
        }

        if ($exist) {
            $exist->quantity = $request->quantity;
            $exist->save();

            return response()->json([
                'message' => "Product quantity updated successfully",
            ]);
        } else {
            return response()->json([
                'message' => "Product not found",
            ]);
        }
    }


    /**
     * This function returns the order confirmation page
     * @param $orderNumber
     * @return Factory|View|Application
     */
    public function confirmation($orderNumber): View|Factory|Application
    {
        $order = Order::findOrFail($orderNumber);

        $order->update([
            'status' => 'confirmed',
        ]);

        return view('confirmation', compact('order'));
    }
}
