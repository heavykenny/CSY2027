<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * This class handles all the wishlist related functions
 */
class WishlistController extends Controller
{
    /** this function adds a product to the wishlist
     *  this is called via ajax
     * @param Request $request
     * @return JsonResponse
     */
    public function addToWishlist(Request $request): JsonResponse
    {
        // validate the request
        $request->validate([
            'client_id' => 'required',
            'product_id' => 'required',
        ]);

        // check if the product is already in the wishlist
        $exist = Wishlist::where('client_id', $request->client_id)->where('product_id', $request->product_id)->exists();

        // if the product is already in the wishlist, return a json response with an error message
        if ($exist) {
            return response()->json([
                'message' => 'Product already in wishlist',
            ], 409);
        }

        // create a new wishlist item
        Wishlist::create([
            'client_id' => $request->client_id,
            'product_id' => $request->product_id,
        ]);

        // put the number of items in the wishlist in the session
        $wishlistCount = Wishlist::where('client_id', $request->client_id)->count();
        session()->put('wishlistCount', $wishlistCount);

        return response()->json([
            'message' => 'Product added to wishlist successfully'
        ]);
    }

    /**
     * This function gets all the items in the wishlist of the logged-in user
     * @param Request $request
     * @return Factory|View|Application|RedirectResponse
     */
    public function getWishlist(Request $request): View|Application|Factory|RedirectResponse
    {
        // get all the items in the wishlist of the logged-in user
        $client_id = auth()->user()->id;

        // put the number of items in the wishlist in the session
        $wishlists = Wishlist::where('client_id', $client_id)->get();
        session()->put('wishlistCount', $wishlists->count());

        // if the wishlist is empty, redirect to the shop page with an error message
        if ($wishlists->count() == 0) {
            return redirect()->back()->with('error', 'Your wishlist is empty');
        }

        return view('wishlist', compact('wishlists'));
    }


    /**
     *  This function removes a product from the wishlist and adds it to the cart
     *  and the function is called via ajax
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function moveToCart(Request $request): JsonResponse
    {
        // validate the request
        $request->validate([
            'wishlist_id' => 'required',
        ]);

        // get the wishlist item
        $wishlist = Wishlist::with('product')->find($request->wishlist_id);

        // if the wishlist item is not found, return a json response with an error message
        if (!$wishlist) {
            return response()->json([
                'message' => 'Wishlist item not found',
            ], 404);
        }

        // validate the user is owner of the wishlist item
        if ($wishlist->client_id != auth()->user()->id) {
            return response()->json([
                'message' => 'You are not authorized to perform this action',
            ], 401);
        }

        //  check if the product is already in the cart
        $cart = Cart::with('product')->where('client_id', $wishlist->client_id)
            ->where('product_id', $wishlist->product_id)->first();

        // if the product is already in the cart, return a json response with an error message
        if ($cart != null) {
            $wishlist->delete();
            return response()->json([
                'message' => 'Product already in cart',
            ], 409);
        }

        // check if the product is out of stock
        if ($wishlist->product->quantity < 1) {
            return response()->json([
                'message' => 'Product is out of stock, please try again later',
            ], 409);
        }

        // create a new cart item
        // the quantity is set to 1 and the size is set to the first size in the product sizes array
        Cart::create([
            'client_id' => $wishlist->client_id,
            'product_id' => $wishlist->product_id,
            'quantity' => 1,
            'size' => $wishlist->product->sizes[0],
        ]);

        $wishlist->delete();

        // put the number of items in the wishlist and cart in the session
        session()->put('wishlistCount', Wishlist::where('client_id', $wishlist->client_id)->count());
        session()->put('cartCount', Cart::where('client_id', $wishlist->client_id)->count());

        return response()->json([
            'message' => 'Product moved to cart successfully',
        ]);
    }


    /**
     * This function removes a product from the wishlist
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function removeFromWishlist(Request $request, $id): JsonResponse
    {
        // get the wishlist item
        $wishlist = Wishlist::find($id);

        if (!$wishlist) {
            return response()->json([
                'message' => 'Wishlist item not found',
            ], 404);
        }

        // validate the user is owner of the wishlist item
        if ($wishlist->client_id != auth()->user()->id) {
            return response()->json([
                'message' => 'You are not authorized to perform this action',
            ], 401);
        }

        $wishlist->delete();

        return response()->json([
            'message' => 'Product removed from wishlist successfully',
        ]);
    }
}
