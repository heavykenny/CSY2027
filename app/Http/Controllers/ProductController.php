<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * This class handles all the product related functions
 *
 */
class ProductController extends Controller
{
    /**
     *  This function gets all the products and displays them in the product index page
     *  it is only accessible by the admin and client
     * @return Factory|View|Application
     */
    public function index(): Application|View|Factory
    {
        // get all products from the database
        // view all if user is admin
        // view only the products of the vendor if user is vendor
        $products = Product::orderBy('created_at', 'desc')->get();

        if (auth()->user()->isVendor()) {
            $products = $products->where('vendor_id', auth()->user()->vendor->id);
        }

        return view('admin.product-index', compact('products'));
    }

    /**
     *  This function gets all the products and displays them in the product index page
     * it is only accessible by the admin and client
     * @return Factory|View|Application
     */
    public function create(): Application|View|Factory
    {
        $vendors = Vendor::all();
        $categories = Category::all();
        return view('admin.product-create', compact('vendors', 'categories'));
    }

    /**
     * this function gets a product and displays it in the product show page
     * it is only accessible by the admin and client
     *
     * @param Product $product
     * @return Factory|View|Application
     */
    public function show(Product $product): Application|View|Factory
    {
        $reviews = $product->reviews()->orderBy('created_at', 'desc')->get();

        return view('admin.product-show', compact('product', 'reviews'));
    }

    /**
     * this function gets a product and displays it in the product edit page
     * it is only accessible by the admin
     *
     * @param Product $product
     * @return Factory|View|Application
     */
    public function edit(Product $product): Application|View|Factory
    {
        $vendors = Vendor::all();
        $categories = Category::all();

        return view('admin.product-edit', compact('product', 'vendors', 'categories'));
    }

    /**
     *  this function updates the product details
     *
     * @param Request $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        // validate the data
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:1024',
            'sizes' => 'nullable',
            'vendor_id' => 'required|exists:vendors,id',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
        ]);


        // check if the user uploaded a new image
        // if they did, delete the old one and upload the new one
        // else, keep the old image
        if ($request->hasFile('image')) {
            Storage::delete($product->image_url);
            $imagePath = $request->file('image')->store('public/images');
            $imageUrl = Storage::url($imagePath);
            $product->image_url = $imageUrl;
        }

        // update the product details
        $product->name = $request['name'];
        $product->description = $request['description'];
        $product->price = $request['price'];
        $product->vendor_id = $request->vendor_id ?? Auth::user()->vendor_id;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->sizes = explode(',', $request['sizes'] ?? '');
        $product->save();

        return redirect()->route('products.show', $product)->with('success', 'Product updated successfully!');
    }

    /**
     * this function creates a new product
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // validate the data
        // if the validation fails, redirect back to the create page with the errors
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|max:1024',
            'sizes' => 'nullable',
            'vendor_id' => 'nullable|exists:vendors,id',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
        ]);

        // upload the image to the storage
        $imagePath = $request->file('image')->store('public/images');

        // create the product
        // if the user is a vendor, assign the product to them
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->image_url = Storage::url($imagePath);
        $product->vendor_id = $request->vendor_id ?? Auth::user()->vendor_id;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->sizes = explode(',', $validatedData['sizes'] ?? '');
        $product->save();

        return redirect()->route('products.show', $product)->with('success', 'Product created successfully!');
    }

    /**
     *  this function deletes a product
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        Storage::delete($product->image_url);
        $product->delete();

        return redirect()->route('admin.product-index')->with('success', 'Product deleted successfully!');
    }
}
