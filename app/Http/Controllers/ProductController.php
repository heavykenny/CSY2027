<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Vendor;
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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|max:1024',
            'sizes' => 'nullable',
            'vendor_id' => 'required|exists:vendors,id'
        ]);

        $imagePath = $request->file('image')->store('public/images');
        $imageUrl = Storage::url($imagePath);

        $product = new Product();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->image_url = $imageUrl;
        $product->vendor_id = $request->vendor_id ?? Auth::user()->vendor_id;
        $product->sizes = explode(',', $validatedData['sizes'] ?? '');
        $product->save();

        return redirect()->route('products.show', $product)->with('success', 'Product created successfully!');
    }


    public function create()
    {
        $vendors = Vendor::all();
        return view('admin.product-create', compact('vendors'));
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
            'vendor_id' => 'required|exists:vendors,id'
        ]);

        if ($request->hasFile('image')) {
            Storage::delete($product->image_path);
            $imagePath = $request->file('image')->store('public/images');
            $imageUrl = Storage::url($imagePath);
            $product->image_url = $imageUrl;
        }

        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->vendor_id = $request->vendor_id ?? Auth::user()->vendor_id;
        $product->sizes = explode(',', $validatedData['sizes'] ?? '');
        $product->save();

        return redirect()->route('admin.product-show', $product);
    }

    public function destroy(Product $product)
    {
        Storage::delete($product->image_path);
        $product->delete();

        return redirect()->route('admin.product-index');
    }
}
