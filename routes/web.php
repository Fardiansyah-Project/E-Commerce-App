<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [HomeController::class, 'showProducts'])->name('products');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/increase/{id}', [CartController::class, 'increaseQty'])->name('cart.increase');
    Route::post('/cart/decrease/{id}', [CartController::class, 'decreaseQty'])->name('cart.decrease');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/orders/{id}/upload-proof', [OrderController::class, 'uploadPaymentProof'])->name('order.upload_proof');
    // Route::get('/my-orders', OrderController::class.'@index')->name('orders.index');
});

// Admin Routes
Route::middleware(['auth', 'Admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.products.store');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('/destroy/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/show/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
        Route::put('/{id}/update-status', [OrderController::class, 'updateStatus'])->name('admin.orders.update_status');
    });
});
