<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::paginate(8);

        return view('welcome', compact('products'));
    }

    public function shop()
    {
        $products = Product::paginate(8);

        return view('shop', compact('products'));
    }

    public function loadMore(Request $request): \Illuminate\Http\JsonResponse
    {
        $products = Product::paginate(4, ['*'], 'page', $request->page);
        $html = view('layouts.partial.product', compact('products'))->render();

        return response()->json([
            'html' => $html,
            'nextPage' => $products->nextPageUrl(),
        ]);
    }

    public function details(Product $product)
    {
        //eager loading
        $product->load(['vendor', 'reviews']);

        return view('product-details', compact('product'));
    }




}
