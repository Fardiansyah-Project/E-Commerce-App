<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('/register')->group(function () {
    Route::get('/', [AuthController::class, 'register'])->name('register');
    Route::post('/store', [AuthController::class, 'store'])->name('register.store');
    Route::get('/edit-address/{id}', [AuthController::class, 'editAddress'])->name('register.edit-address');
    Route::post('/update-address/{id}', [AuthController::class, 'updateAddress'])->name('register.update-address');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [HomeController::class, 'showProducts'])->name('products');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::middleware(['auth'])->group(function () {
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add', [CartController::class, 'add'])->name('cart.add');
        Route::post('/increase/{id}', [CartController::class, 'increaseQty'])->name('cart.increase');
        Route::post('/decrease/{id}', [CartController::class, 'decreaseQty'])->name('cart.decrease');
        Route::delete('/remove/{itemId}', [CartController::class, 'remove'])->name('cart.remove');
    });
    Route::prefix('checkout')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/store', [CheckoutController::class, 'store'])->name('checkout.store');
    });
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/store', [OrderController::class, 'store'])->name('orders.store');
        Route::post('/{id}/upload-proof', [OrderController::class, 'uploadPaymentProof'])->name('order.upload_proof');
        Route::put('/{id}/cancel', [OrderController::class, 'cancel'])->name('admin.orders.cancel');
        Route::delete('/destroy/items/{id}', [OrderController::class, 'destroyItems'])->name('orders.destroy');
        Route::put('/{id}/restore', [OrderController::class, 'restore'])->name('orders.restore');
        Route::get('/order/trashed', [OrderController::class, 'trashed'])->name('orders.trashed');
        // Route::get('/my-orders', OrderController::class.'@index')->name('orders.index');
    });
});
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
        Route::get('/get-order', [OrderController::class, 'getOrder'])->name('admin.orders.index');
        Route::get('/show/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
        Route::put('/{id}/update-status', [OrderController::class, 'updateStatus'])->name('admin.orders.update_status');
        Route::get('/edit-status/{id}', [OrderController::class, 'editStatus'])->name('admin.orders.edit_status');
        Route::get('/success', [OrderController::class, 'getSuccess'])->name('admin.orders.success');
        Route::get('/history', [OrderController::class, 'getAllData'])->name('admin.orders.history');
        Route::delete('/destroy/{id}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
    });
    Route::prefix('users')->group(function () {
        Route::get('/customers', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/admins', [UserController::class, 'admin'])->name('admin.users.admin');
        Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/store', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/destroy/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });
});
