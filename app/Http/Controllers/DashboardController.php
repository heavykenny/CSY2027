<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * This class handles all the dashboard related functions
 *
 */
class DashboardController extends Controller
{
    /**
     * @return View|Factory|Application
     */
    public function index(): View|Factory|Application
    {
        // if user is client, make some queries to get the data
        if (auth()->user()->role->name === 'client') {
            return $this->clientDashboard();
        }

        // get the latest 10 orders
        $orders = Order::orderBy('created_at', 'desc')->take(10)->get();

        // get total orders, total products, total clients, total vendors
        // return the view with the data
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalClients = Client::count();
        $totalVendors = Vendor::count();
        $totalSales = Order::sum('total_amount');

        return view('admin.home', compact('orders', 'totalOrders', 'totalProducts', 'totalClients', 'totalVendors', 'totalSales'));
    }

    /**
     * @return View|Factory|Application
     */
    private function clientDashboard(): View|Factory|Application
    {
        // get the latest 10 orders
        $orders = Order::where('client_id', auth()->user()->id)->orderBy('created_at', 'desc')->take(10)->get();

        // get total orders, total products, total clients, total vendors, total sales for client's vendor
        // return the view with the data
        $totalOrders = Order::where('client_id', auth()->user()->id)->count();
        $totalProducts = Product::where('vendor_id', auth()->user()->vendor->id)->count();
        $totalClients = Client::where('vendor_id', auth()->user()->vendor->id)->count();
        $totalVendors = Vendor::count();
        $totalSales = Order::where('client_id', auth()->user()->id)->sum('total_amount');

        return view('admin.home', compact('orders', 'totalOrders', 'totalProducts', 'totalClients', 'totalVendors', 'totalSales'));
    }
}
