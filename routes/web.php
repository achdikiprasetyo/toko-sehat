<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProfileController;


use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\SellerRequestController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');



// Halaman login
Route::get('/login', function () {
    return view('autentikasi.login');
})->name('login');

// Halaman register
Route::get('/register', function () {
    return view('autentikasi.register');
})->name('register');

Route::get('/product', function () {
    return view('product.list');
})->name('product');



Route::get('/produk', [ListController::class, 'index'])->name('produk.list');

Route::get('/kategori/{id}', [ListController::class, 'produkByKategori'])->name('produk.byKategori');

// Menambahkan produk ke keranjang


// Proses checkout dan pembayaran





# Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

# Login
Route::get('/login', [AuthController::class, 'showlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

# Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->group(function () {
    # Admin Dashboard
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    # CRUD Kategori
    Route::get('admin/kategori', [CategoryController::class, 'index'])->name('kategori.index');
    Route::get('admin/kategori/create', [CategoryController::class, 'create'])->name('kategori.create');
    Route::post('admin/kategori', [CategoryController::class, 'store'])->name('kategori.store');
    Route::get('admin/kategori/{categorys}/edit', [CategoryController::class, 'edit'])->name('kategori.edit');
    Route::put('admin/kategori/{categorys}', [CategoryController::class, 'update'])->name('kategori.update');
    Route::delete('admin/kategori/{category}', [CategoryController::class, 'destroy'])->name('kategori.destroy');


    Route::get('admin/produk', [ProductController::class, 'index'])->name('produk.index');
    Route::get('admin/produk/create', [ProductController::class, 'create'])->name('produk.create');
    Route::post('admin/produk', [ProductController::class, 'store'])->name('produk.store');
    Route::get('admin/produk/{id}/edit', [ProductController::class, 'edit'])->name('produk.edit');
    Route::put('admin/produk/{id}', [ProductController::class, 'update'])->name('produk.update');
    Route::delete('admin/produk/{id}', [ProductController::class, 'destroy'])->name('produk.destroy');

    # Manage Customer
    Route::get('admin/users', [UserController::class, 'index'])->name('customer.index');
    Route::get('admin/customer/create', [UserController::class, 'create'])->name('customer.create');
    Route::post('admin/customer', [UserController::class, 'store'])->name('customer.store');

    Route::get('admin/customer/{id}/edit', [UserController::class, 'edit'])->name('customer.edit');
    Route::put('admin/customer/{id}', [UserController::class, 'update'])->name('customer.update');

    Route::delete('admin/customer/{id}', [UserController::class, 'destroy'])->name('customer.destroy');

    # Customer
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    Route::get('/produk/{id}', [ListController::class, 'show'])->name('produk.show');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

    Route::post('/cart/add', [ListController::class, 'addToCart'])->name('cart.add');

    // Menampilkan keranjang
    Route::get('/keranjang', [ListController::class, 'viewCart'])->name('keranjang.index');

    // Menghapus produk dari keranjang
    Route::delete('/cart/remove/{id}', [ListController::class, 'removeFromCart'])->name('cart.destroy');

    Route::get('/history', [CheckoutController::class, 'history'])->name('history.index');
    Route::post('/history/cancel/{id}', [CheckoutController::class, 'cancel'])->name('history.cancel');

    Route::get('/checkout/{id}/print', [CheckoutController::class, 'print'])->name('checkout.print');

     Route::get('/admin/shipping', [ShippingController::class, 'index'])->name('admin.shipping');
    Route::post('/admin/shipping/update/{id}', [ShippingController::class, 'updateStatus'])->name('admin.shipping.update');

    Route::get('seller-requests', [SellerRequestController::class, 'index'])->name('sellerRequests.index');

    // Menyetujui request seller
    Route::post('seller-requests/{id}/approve', [SellerRequestController::class, 'approve'])->name('sellerRequests.approve');

    // Menolak request seller
    Route::post('seller-requests/{id}/reject', [SellerRequestController::class, 'reject'])->name('sellerRequests.reject');
// routes/web.php
Route::post('/seller-request', [SellerRequestController::class, 'store'])->name('seller.request');

Route::get('/seller', [SellerRequestController::class, 'toko'])->name('seller.customer');

    

});
