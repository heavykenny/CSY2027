<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request): JsonResponse
    {
        $request->validate([
            'client_id' => 'required',
            'product_id' => 'required',
        ]);

        $exist = Wishlist::where('client_id', $request->client_id)->where('product_id', $request->product_id)->exists();

        if ($exist) {
            return response()->json([
                'message' => 'Product already in wishlist',
            ], 409);
        }

        Wishlist::create([
            'client_id' => $request->client_id,
            'product_id' => $request->product_id,
        ]);

        $wishlistCount = Wishlist::where('client_id', $request->client_id)->count();

        session()->put('wishlistCount', $wishlistCount);

        return response()->json([
            'message' => 'Product added to wishlist successfully'
        ]);
    }

    public function getWishlist(Request $request)
    {
        $client_id = auth()->user()->id;

        $wishlists = Wishlist::where('client_id', $client_id)->get();
        session()->put('wishlistCount', $wishlists->count());

        if ($wishlists->count() == 0) {
            return redirect()->back()->with('error', 'Your wishlist is empty');
        }

        return view('wishlist', compact('wishlists'));
    }


    public function moveToCart(Request $request)
    {
        $request->validate([
            'wishlist_id' => 'required',
        ]);

        $wishlist = Wishlist::with('product')->find($request->wishlist_id);

        if (!$wishlist) {
            return response()->json([
                'message' => 'Wishlist item not found',
            ], 404);
        }

        $cart = Cart::with('product')->where('client_id', $wishlist->client_id)
            ->where('product_id', $wishlist->product_id)->first();


        if ($cart != null) {
            $wishlist->delete();
            return response()->json([
                'message' => 'Product already in cart',
            ], 409);
        }

        if ($wishlist->product->quantity < 1) {
            return response()->json([
                'message' => 'Product is out of stock, please try again later',
            ], 409);
        }


        Cart::create([
            'client_id' => $wishlist->client_id,
            'product_id' => $wishlist->product_id,
            'quantity' => 1,
            'size' => $wishlist->product->sizes[0],
        ]);

        $wishlist->delete();
        session()->put('wishlistCount', Wishlist::where('client_id', $wishlist->client_id)->count());
        session()->put('cartCount', Cart::where('client_id', $wishlist->client_id)->count());

        return response()->json([
            'message' => 'Product moved to cart successfully',
        ]);
    }


    public function removeFromWishlist(Request $request, $id): JsonResponse
    {
        $wishlist = Wishlist::find($id);

        if (!$wishlist) {
            return response()->json([
                'message' => 'Wishlist item not found',
            ], 404);
        }

        $wishlist->delete();

        return response()->json([
            'message' => 'Product removed from wishlist successfully',
        ]);
    }
}
