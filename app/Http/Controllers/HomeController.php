<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(): Factory|View|Application
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(8);

        return view('welcome', compact('products'));
    }

    public function shop(): Factory|View|Application
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(8);

        $categories = Category::all();

        return view('shop', compact('products', 'categories'));
    }

    public function loadMore(Request $request): JsonResponse
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(4, ['*'], 'page', $request->page);
        $html = view('layouts.partial.product', compact('products'))->render();

        return response()->json([
            'html' => $html,
            'nextPage' => $products->nextPageUrl(),
        ]);
    }

    public function details(Product $product): Factory|View|Application
    {
        //eager loading
        $product->load(['vendor', 'reviews']);

        return view('product-details', compact('product'));
    }


}
