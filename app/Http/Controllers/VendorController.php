<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * This class handles all the vendor related functions
 *
 */
class VendorController extends Controller
{
    /**
     * This function gets all the vendors and displays them in the vendor index page
     *
     * @return Factory|View|Application
     */
    public function index(): Application|View|Factory
    {
        $vendors = Vendor::all();

        return view('vendor.index', compact('vendors'));
    }

    /**
     *  This function creates a new vendor and redirects to the vendor show page
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        $vendor = Vendor::create($validatedData);

        return redirect()->route('vendors.show', $vendor)->with('success', 'Vendor created successfully.');
    }

    /**
     *  this shows the vendor create page
     *
     * @return Factory|View|Application|RedirectResponse
     */
    public function create(): Application|View|Factory|RedirectResponse
    {
        if (auth()->user()->isVendor()) {
            return redirect()->back()->with('error', 'You are not authorized to perform this action.');
        }

        return view('vendor.create');
    }

    /**
     * this function gets a vendor and displays it in the vendor show page
     *
     * @param Vendor $vendor
     * @return Factory|View|Application
     */
    public function show(Vendor $vendor): Application|View|Factory
    {
        return view('vendor.show', compact('vendor'));
    }

    /**
     * this updates a vendor and redirects to the vendor show page
     *
     * @param Request $request
     * @param Vendor $vendor
     * @return RedirectResponse
     */
    public function update(Request $request, Vendor $vendor): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
        ]);

        $vendor->update($validatedData);

        return redirect()->route('vendor.show', $vendor)->with('success', 'Vendor updated successfully.');
    }

    /**
     * this function deletes a vendor and redirects to the vendor index page
     *
     * @param Vendor $vendor
     * @return RedirectResponse
     */
    public function destroy(Vendor $vendor): RedirectResponse
    {
        $vendor->delete();

        return redirect()->route('vendor.index')->with('success', 'Vendor deleted successfully.');
    }
}
