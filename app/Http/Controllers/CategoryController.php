<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): Factory|View|Application
    {
        $categories = Category::all();

        return view('admin.category-index', compact('categories'));
    }

    public function show(Category $category):Factory|View|Application
    {
        $products = $category->products()->orderBy('created_at', 'desc')->get();

        return view('admin.category-show', compact('category', 'products'));
    }

    public function edit(Category $category):Factory|View|Application
    {
        return view('admin.category-edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];

        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');;
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        Category::create($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function create():Factory|View|Application
    {
        return view('admin.category-create');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
