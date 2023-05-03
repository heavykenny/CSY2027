<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * This class handles all the category related functions
 *
 */
class CategoryController extends Controller
{
    /**
     * This function gets all the categories and displays them in the category index page
     * it is only accessible by the admin and client
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $categories = Category::all();

        return view('admin.category-index', compact('categories'));
    }

    /**
     * This function gets all the products in a category and displays them in the category show page
     * it is only accessible by the admin and client
     *
     * @param Category $category
     * @return Factory|View|Application
     */
    public function show(Category $category): Factory|View|Application
    {
        // get all the products in the category
        // and order them by the date they were created
        $products = $category->products()->orderBy('created_at', 'desc')->get();

        return view('admin.category-show', compact('category', 'products'));
    }

    /**
     * This function gets a category and displays it in the category edit page
     * it is only accessible by the admin
     *
     * @param Category $category
     * @return Factory|View|Application
     */
    public function edit(Category $category): Factory|View|Application
    {
        return view('admin.category-edit', compact('category'));
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        // validate the request for the required fields
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];

        $category->save();

        // redirect to the category index page with a success message
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * This function creates a new category
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // validate the request for the required fields
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        // create the category
        Category::create($validatedData);

        // redirect to the category index page with a success message
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * This function displays the category create page
     *
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('admin.category-create');
    }

    /**
     *  This function deletes a category
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        // redirect to the category index page with a success message
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
