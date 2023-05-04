<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * This class handles all the order related functions
 */
class OrderController extends Controller
{
    /**
     * This function gets all the orders of a user and displays them in user the order page
     *
     * @param Request $request
     * @return Factory|View|Application
     */
    public function userOrderIndex(Request $request): Application|View|Factory
    {
        // order by created_at desc to show the latest order first
        // paginate the orders to show 10 orders per page
        // load the client and vendor relationship
        // return the view with the orders

        $orders = Order::where('client_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /**
     *  This function gets all the orders and displays them in the order index page
     *  it is only accessible by the admin
     * @return Factory|View|Application
     */
    public function adminOrderIndex(): Application|View|Factory
    {
        // order by created_at desc to show the latest order first
        // paginate the orders to show 10 orders per page
        // load the client and vendor relationship
        // return the view with the orders

        $orders = Order::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.order-index', compact('orders'));
    }

    /**
     * this function displays the order details page
     * it is only accessible by the admin and client
     *
     * @param Order $order
     * @return Factory|View|Application|RedirectResponse
     */
    public function adminOrderShow(Order $order): Application|View|Factory|RedirectResponse
    {
        // load the client, vendor and items relationship
        $order->load('client', 'vendor', 'items.product');

        // validate the user is the owner of the order
        // if not redirect back with an error message
        if (auth()->user()->id !== $order->client_id && !auth()->user()->isAdmin() && !auth()->user()->isVendorAndOwnsProduct($order->vendor_id)) {
            return redirect()->back()->with('error', 'You are not authorized to view this order');
        }
        return view('admin.order-details', compact('order'));
    }

    /**
     * This function displays the order edit page
     * it is only accessible by the admin and client
     *
     * @param Order $order
     * @param Request $request
     * @return RedirectResponse
     */
    public function adminOrderUpdate(Order $order, Request $request): RedirectResponse
    {
        // validate the request
        $validatedData = $request->validate([
            'status' => 'required|string',
        ]);

        // validate the user is the owner of the order
        // if not redirect back with an error message
        if (auth()->user()->id !== $order->client_id && !auth()->user()->isAdmin() && !auth()->user()->isVendorAndOwnsProduct($order->vendor_id)) {
            return redirect()->back()->with('error', 'You are not authorized to update this order');
        }

        // update the order status
        $order->update($validatedData);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Order status updated successfully');
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return RedirectResponse
     */
    public function update(Request $request, Order $order): RedirectResponse
    {
        $validatedData = $request->validate([
            'client_id' => 'required|integer',
            'vendor_id' => 'required|integer',
            'status' => 'required|string',
            'total_amount' => 'required|numeric',
        ]);

        $order->update($validatedData);

        return redirect()->route('orders.show', $order);
    }

    /**
     * This function displays the order summary page
     *
     * @param Order $order
     * @return Factory|View|Application
     */
    public function userOrderShow(Order $order): Application|View|Factory|RedirectResponse
    {
        // load the client, vendor and items relationship
        $order->load('client', 'vendor', 'items.product');

        // validate the user is the owner of the order
        // if not redirect back with an error message
        if (auth()->user()->id !== $order->client_id && !auth()->user()->isAdmin() && !auth()->user()->isVendorAndOwnsProduct($order->vendor_id)) {
            return redirect()->back()->with('error', 'You are not authorized to view this order');
        }

        return view('orders.order_summary', compact('order'));
    }

    /**
     * This function creates a new order
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // validate the request
        $validatedData = $request->validate([
            'client_id' => 'required|integer',
            'vendor_id' => 'required|integer',
            'status' => 'required|string',
            'total_amount' => 'required|numeric',
        ]);

        $order = Order::create($validatedData);

        return redirect()->route('orders.show', $order);
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Application|View|Factory
    {
        return view('orders.create');
    }

    /**
     *  this function displays the order details page
     * @param Order $order
     * @return Factory|View|Application|RedirectResponse
     */
    public function show(Order $order): Application|View|Factory|RedirectResponse
    {
        // load the client, vendor and items relationship
        $order->load('client', 'vendor', 'items.product');

        // validate the user is the owner of the order
        // if not redirect back with an error message
        if (auth()->user()->id !== $order->client_id && !auth()->user()->isAdmin() && !auth()->user()->isVendorAndOwnsProduct($order->vendor_id)) {
            return redirect()->back()->with('error', 'You are not authorized to view this order');
        }

        return view('orders.show', compact('order'));
    }

    /**
     * this function displays the order edit page
     *
     * @param Order $order
     * @return Factory|View|Application|RedirectResponse
     */
    public function edit(Order $order): Application|View|Factory|RedirectResponse
    {
        // validate the user is the owner of the order
        // if not redirect back with an error message
        if (auth()->user()->id !== $order->client_id && !auth()->user()->isAdmin() &&
            !auth()->user()->isVendorAndOwnsProduct($order->vendor_id)) {
            return redirect()->back()->with('error', 'You are not authorized to update this order');
        }

        return view('orders.edit', compact('order'));
    }

    /**
     * this function deletes an order
     *
     * @param Order $order
     * @return RedirectResponse
     */
    public function destroy(Order $order): RedirectResponse
    {
        // validate the user is the owner of the order
        // if not redirect back with an error message
        if (auth()->user()->id !== $order->client_id && !auth()->user()->isAdmin() && auth()->user()->isVendorAndOwnsProduct($order->vendor_id)) {
            return redirect()->back()->with('error', 'You are not authorized to delete this order');
        }
        $order->delete();

        return redirect()->route('orders.index');
    }
}
