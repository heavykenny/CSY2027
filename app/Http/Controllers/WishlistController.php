<?php

namespace App\Http\Controllers;

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


        return response()->json([
            'message' => 'Product added to wishlist successfully'
        ]);
    }

    public function getWishlist(Request $request): JsonResponse
    {
        $wishlist = Wishlist::where('user_id', $request->user_id)->get();

        return response()->json([
            'wishlist' => $wishlist,
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
