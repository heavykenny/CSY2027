<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WishlistController;
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

// home routes
// these routes are not authenticated
Route::get('/', [HomeController::class, 'index'])->name('welcome');
Route::get('/products/load-more', [HomeController::class, 'loadMore'])->name('products.loadMore');
Route::get('/products/{product}', [HomeController::class, 'details'])->name('products.details');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');

// client registration and login routes
Route::get('/login', [ClientController::class, 'showLoginForm'])->name('login');
Route::post('/login', [ClientController::class, 'login'])->middleware('throttle:5,1');
Route::post('/register', [ClientController::class, 'register'])->middleware('throttle:5,1');
Route::post('/logout', [ClientController::class, 'logout'])->name('logout');
Route::get('/logout', [ClientController::class, 'logout'])->name('logout');
Route::get('/register', [ClientController::class, 'showRegistrationForm'])->name('register');

// Admin Routes
// these routes are authenticated and only admin and client can access them
// it is prefixed with admin e.g. /admin/home
Route::prefix('admin')->middleware(['auth', 'admin-vendor'])->group(function () {

    // Dashboard Routes
    Route::get('', [DashboardController::class, 'index'])->name('admin.home');
    Route::get('/home', [DashboardController::class, 'index'])->name('admin.home');

    // client dashboard
    Route::get('/client', [ClientController::class, 'showClientProfile'])->name('client.profile');

    // Vendor Routes
    Route::post('/vendor/assign-clients', [VendorController::class, 'assignClients'])->name('vendor.assignClients');
    Route::get('/vendor', [VendorController::class, 'index'])->name('vendor.index');
    Route::get('/vendor/create', [VendorController::class, 'create'])->name('vendor.create');
    Route::post('/vendor', [VendorController::class, 'store'])->name('vendor.store');
    Route::get('/vendor/{vendor}', [VendorController::class, 'show'])->name('vendor.show');
    Route::delete('/vendor/{vendor}', [VendorController::class, 'destroy'])->name('vendor.destroy');
    Route::put('/vendor/{vendor}', [VendorController::class, 'update'])->name('vendor.update');


    // client routes
    Route::get('/client', [ClientController::class, 'index'])->name('client.index');
    Route::get('/client/create', [ClientController::class, 'create'])->name('client.create');
    Route::post('/client', [ClientController::class, 'store'])->name('client.store');
    Route::get('/client/{client}', [ClientController::class, 'show'])->name('client.show');
    Route::delete('/client/{client}', [ClientController::class, 'destroy'])->name('client.destroy');
    Route::put('/client/{client}', [ClientController::class, 'update'])->name('client.update');

    // order routes
    Route::get('/orders', [OrderController::class, 'adminOrderIndex'])->name('admin.orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'adminOrderShow'])->name('admin.orders.show');
    Route::put('/orders/{order}', [OrderController::class, 'adminOrderUpdate'])->name('admin.orders.update');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

    // product routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // category routes
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');


//    Route::get('/order-items', [OrderItemController::class, 'index'])->name('order_items.index');
//    Route::get('/order-items/create', [OrderItemController::class, 'create'])->name('order_items.create');
//    Route::post('/order-items', [OrderItemController::class, 'store'])->name('order_items.store');
//    Route::get('/order-items/{orderItem}', [OrderItemController::class, 'show'])->name('order_items.show');
//    Route::get('/order-items/{orderItem}/edit', [OrderItemController::class, 'edit'])->name('order_items.edit');
//    Route::put('/order-items/{orderItem}', [OrderItemController::class, 'update'])->name('order_items.update');
//    Route::delete('/order-items/{orderItem}', [OrderItemController::class, 'destroy'])->name('order_items.destroy');

    // permission routes
    Route::get('/permissions', [PermissionController::class, "index"])->name('permission.index');
    Route::post('/permissions', [PermissionController::class, "store"])->name('permission.store');
});


// Authenticated Routes for users
Route::group(['middleware' => ['auth']], function () {
    // wishlist routes
    Route::get('/wishlist', [WishlistController::class, "getWishlist"])->name('wishlist.get');
    Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
    Route::post('/wishlist/move-to-cart', [WishlistController::class, 'moveToCart'])->name('wishlist.move');

    // cart routes
    Route::get('/cart', [CartController::class, "getAllCarts"])->name('cart.get');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');

    // checkout routes
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.get');
    Route::get('/confirmation/{order_id}', [CartController::class, 'confirmation'])->name('checkout.confirmation');

    // profile routes
    Route::get('/profile', [ClientController::class, 'profile'])->name('profile.index');
    Route::put('/profile', [ClientController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [ClientController::class, 'updatePassword'])->name('profile.password');

    // user orders routes
    Route::get('/orders', [OrderController::class, 'userOrderIndex'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'userOrderShow'])->name('orders.show');


    // ratings and reviews
    Route::post('/reviews', [ReviewController::class, 'storeReviews'])->name('reviews.store');
});
