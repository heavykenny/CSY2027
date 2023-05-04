<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

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
        if (auth()->user()->isVendor()) {
            return $this->vendorDashboard();
        }

        // get the latest 10 orders
        $orders = Order::orderBy('created_at', 'desc')->take(10)->get();

        // get total orders, total products, total clients, total vendors
        // return the view with the data
        $totalOrders = Order::count();
        $totalProducts = Product::count();

        $totalVendors = Vendor::count();
        $totalSales = Order::sum('total_amount');

        return view('admin.home', compact('orders', 'totalOrders', 'totalProducts', 'totalVendors', 'totalSales'));
    }

    /**
     * @return View|Factory|Application
     */
    private function vendorDashboard(): View|Factory|Application
    {
        // get the latest 10 orders
        $totalVendors = Vendor::count();

        $orders = Order::with('client')->select('orders.*', 'clients.name')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('clients', 'orders.client_id', '=', 'clients.id')
            ->where('products.vendor_id', auth()->user()->vendor->id)
            ->get();

        $totalProducts = Product::where('vendor_id', auth()->user()->vendor->id)->count();
        $totalSales = $orders->sum('total_amount');
        $totalOrders = $orders->count();

        $orders = $orders->take(10);

        return view('admin.home', compact('orders', 'totalOrders', 'totalProducts', 'totalVendors', 'totalSales'));
    }
}
