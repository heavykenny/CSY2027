<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * This class handles all the home related functions
 *
 */
class HomeController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        // get all the products and order them by the date they were created
        // and paginate them by 8
        $products = Product::orderBy('created_at', 'desc')->paginate(8);

        return view('welcome', compact('products'));
    }

    /**
     *  This function gets all the products and displays them in the shop page
     * @return Factory|View|Application
     */
    public function shop(): Factory|View|Application
    {
        // get all the products and order them by the date they were created
        // and paginate them by 8
        $products = Product::orderBy('created_at', 'desc')->paginate(8);

        // get all the categories
        $categories = Category::all();

        return view('shop', compact('products', 'categories'));
    }

    /**
     * This function gets all the products in a category and displays them in the category show page
     * it is called by the ajax request from home page
     * @param Request $request
     * @return JsonResponse
     */
    public function loadMore(Request $request): JsonResponse
    {
        // get all the products and order them by the date they were created
        // and paginate them by 4
        $products = Product::orderBy('created_at', 'desc')->paginate(4, ['*'], 'page', $request->page);
        // render the view and convert it to a string
        $html = view('layouts.partial.product', compact('products'))->render();

        // return the html and the next page url
        return response()->json([
            'html' => $html,
            'nextPage' => $products->nextPageUrl(),
        ]);
    }

    /**
     *  This function gets a product and displays it in the product details page
     * @param Product $product
     * @return Factory|View|Application
     */
    public function details(Product $product): Factory|View|Application
    {
        // load the product with its vendor and reviews via eager loading
        $product->load(['vendor', 'reviews']);

        return view('product-details', compact('product'));
    }


}
