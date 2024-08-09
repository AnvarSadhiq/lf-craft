<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

route::get('/', [HomeController::class, 'home']);


route::get('/dashboard', [HomeController::class, 'login_home'])->middleware(['auth', 'verified'])->name('dashboard');;

// My Orders Section
route::get('/myorders', [HomeController::class, 'myorders'])->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin']);

// Category View Section
route::get('view_category', [AdminController::class, 'view_category'])->middleware(['auth', 'admin']);

// Add Category Section
route::post('add_category', [AdminController::class, 'add_category'])->middleware(['auth', 'admin']);

// Edit Category Section
route::get('edit_category/{id}', [AdminController::class, 'edit_category'])->middleware(['auth', 'admin']);

// Update Category Section
route::post('update_category/{id}', [AdminController::class, 'update_category'])->middleware(['auth', 'admin']);

// Delete Category Section
route::get('delete_category/{id}', [AdminController::class, 'delete_category'])->middleware(['auth', 'admin']);

// Add Product Section
route::get('add_product', [AdminController::class, 'add_product'])->middleware(['auth', 'admin']);

// Upload Product Section
route::post('upload_product', [AdminController::class, 'upload_product'])->middleware(['auth', 'admin']);

// View Product Section
route::get('view_product', [AdminController::class, 'view_product'])->middleware(['auth', 'admin']);

// delete Product Section
route::get('delete_product/{id}', [AdminController::class, 'delete_product'])->middleware(['auth', 'admin']);

// Edit Product Section
route::get('edit_product/{id}', [AdminController::class, 'edit_product'])->middleware(['auth', 'admin']);

// Update Product Section
route::post('update_product/{id}', [AdminController::class, 'update_product'])->middleware(['auth', 'admin']);

// Search Products Section
route::get('product_search', [AdminController::class, 'product_search'])->middleware(['auth', 'admin']);

//  Product Details Section
route::get('product_details/{id}', [HomeController::class, 'product_details']);

//  Add to Cart Section
route::get('add_cart/{id}', [HomeController::class, 'add_cart'])->middleware(['auth', 'verified']);

//  Showing Carts Section
route::get('mycart', [HomeController::class, 'mycart'])->middleware(['auth', 'verified']);

//  Deleting Carts Section
route::get('delete_cart/{id}', [HomeController::class, 'delete_cart'])->middleware(['auth', 'verified']);

//  Cunfirm Order Section
route::post('confirm_order', [HomeController::class, 'confirm_order'])->middleware(['auth', 'verified']);

//  Shop Section
route::get('shop', [HomeController::class, 'shop']);

//  Why Us Section
route::get('why', [HomeController::class, 'why']);

//  Service Section
route::get('service', [HomeController::class, 'service']);

//  Contact Section
route::get('contact', [HomeController::class, 'contact']);

//  View Orders Section
route::get('view_orders', [AdminController::class, 'view_orders'])->middleware(['auth', 'admin']);

// Order Status change to on the way
route::get('on_the_way/{id}', [AdminController::class, 'on_the_way'])->middleware(['auth', 'admin']);

// Order Status change to Delivered
route::get('delivered/{id}', [AdminController::class, 'delivered'])->middleware(['auth', 'admin']);

// Payment Method
Route::controller(HomeController::class)->group(function(){
    Route::get('stripe/{value}', 'stripe');
    Route::post('stripe/{value}', 'stripePost')->name('stripe.post');
});