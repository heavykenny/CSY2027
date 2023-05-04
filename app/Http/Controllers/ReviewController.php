<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * This function is used by ajax request to store reviews.
     * Store a newly created resource in storage.
     */
    public function storeReviews(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'client_id' => 'required|integer',
            'product_id' => 'required|integer:exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:500',
        ]);

        $validatedData['client_id'] = auth()->user()->id;

        $product = Product::find($validatedData['product_id']);

        $product->reviews()->create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Review added successfully',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
