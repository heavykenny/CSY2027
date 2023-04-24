<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('admin.product-index', compact('products'));
    }

    public function create()
    {
        $vendors = Vendor::all();
        $categories = Category::all();
        return view('admin.product-create', compact('vendors', 'categories'));
    }

    public function show(Product $product)
    {
        $reviews = $product->reviews()->orderBy('created_at', 'desc')->get();

        return view('admin.product-show', compact('product', 'reviews'));
    }

    public function edit(Product $product)
    {
        return view('admin.product-edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:1024',
            'sizes' => 'nullable',
            'vendor_id' => 'required|exists:vendors,id',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($product->image_url);
            $imagePath = $request->file('image')->store('public/images');
            $imageUrl = Storage::url($imagePath);
            $product->image_url = $imageUrl;
        }

        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->vendor_id = $request->vendor_id ?? Auth::user()->vendor_id;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->sizes = explode(',', $validatedData['sizes'] ?? '');
        $product->save();

        return redirect()->route('admin.product-show', $product);
    }

    public function store(Request $request): RedirectResponse
    {
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

        $imagePath = $request->file('image')->store('public/images');

        $product = new Product();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->image_url = Storage::url($imagePath);;
        $product->vendor_id = $request->vendor_id ?? Auth::user()->vendor_id;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->sizes = explode(',', $validatedData['sizes'] ?? '');
        $product->save();

        return redirect()->route('products.show', $product)->with('success', 'Product created successfully!');
    }

    public function destroy(Product $product)
    {
        Storage::delete($product->image_url);
        $product->delete();

        return redirect()->route('admin.product-index');
    }
}
