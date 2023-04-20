<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/products/load-more', [HomeController::class, 'loadMore'])->name('products.loadMore');
Route::get('/products/{product}', [HomeController::class, 'details'])->name('products.details');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/login', [ClientController::class, 'showLoginForm'])->name('login');
Route::post('/login', [ClientController::class, 'login']);
Route::post('/logout', [ClientController::class, 'logout'])->name('logout');
Route::get('/logout', [ClientController::class, 'logout'])->name('logout');
Route::get('/register', [ClientController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [ClientController::class, 'register']);


// Admin Routes
Route::prefix('admin')->middleware(['auth', 'admin-vendor'])->group(function () {
    Route::get('', function () {
        return view('admin.home');
    })->name('admin.home');

    Route::get('/home', function () {
        return view('admin.home');
    })->name('admin.home');

    Route::get('/client', [ClientController::class, 'showClientProfile'])->name('client.profile');

    // Vendor Routes
//    Route::get('/vendor/{id}/assign-clients', [VendorController::class, 'showAssignClientsForm'])->name('vendor.assignClientsForm');
    Route::post('/vendor/assign-clients', [VendorController::class, 'assignClients'])->name('vendor.assignClients');

    Route::get('/vendor', [VendorController::class, 'index'])->name('vendor.index');
    Route::get('/vendor/create', [VendorController::class, 'create'])->name('vendor.create');
    Route::post('/vendor', [VendorController::class, 'store'])->name('vendor.store');
    Route::get('/vendor/{vendor}', [VendorController::class, 'show'])->name('vendor.show');
    Route::delete('/vendor/{vendor}', [VendorController::class, 'destroy'])->name('vendor.destroy');
    Route::put('/vendor/{vendor}', [VendorController::class, 'update'])->name('vendor.update');


    Route::get('/client', [ClientController::class, 'index'])->name('client.index');
    Route::get('/client/create', [ClientController::class, 'create'])->name('client.create');
    Route::post('/client', [ClientController::class, 'store'])->name('client.store');
    Route::get('/client/{client}', [ClientController::class, 'show'])->name('client.show');
    Route::delete('/client/{client}', [ClientController::class, 'destroy'])->name('client.destroy');
    Route::put('/client/{client}', [ClientController::class, 'update'])->name('client.update');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    Route::get('/order-items', [OrderItemController::class, 'index'])->name('order_items.index');
    Route::get('/order-items/create', [OrderItemController::class, 'create'])->name('order_items.create');
    Route::post('/order-items', [OrderItemController::class, 'store'])->name('order_items.store');
    Route::get('/order-items/{orderItem}', [OrderItemController::class, 'show'])->name('order_items.show');
    Route::get('/order-items/{orderItem}/edit', [OrderItemController::class, 'edit'])->name('order_items.edit');
    Route::put('/order-items/{orderItem}', [OrderItemController::class, 'update'])->name('order_items.update');
    Route::delete('/order-items/{orderItem}', [OrderItemController::class, 'destroy'])->name('order_items.destroy');

    //
    Route::get('/permissions', [PermissionController::class, "index"])->name('permission.index');
    Route::post('/permissions', [PermissionController::class, "store"])->name('permission.store');
});


//Route::apiResource('vendors', VendorController::class);
//Route::apiResource('orders', OrderController::class);
//Route::apiResource('products', ProductController::class);
//Route::apiResource('order-items', OrderItemController::class);

