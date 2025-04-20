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

// Halaman yang bisa di lihat guest//
# Beranda
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

# Login
Route::get('/login', function () {
    return view('autentikasi.login');
})->name('login');

# Register
Route::get('/register', function () {
    return view('autentikasi.register');
})->name('register');

# List Produk
Route::get('/product', function () {
    return view('product.list');
})->name('product');
Route::get('/produk', [ListController::class, 'index'])->name('produk.list');
Route::get('/kategori/{id}', [ListController::class, 'produkByKategori'])->name('produk.byKategori');

# Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

# Login
Route::get('/login', [AuthController::class, 'showlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

# Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Halaman yang harus login 
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

    #CRUD Produk
    Route::get('admin/produk', [ProductController::class, 'index'])->name('produk.index');
    Route::get('admin/produk/create', [ProductController::class, 'create'])->name('produk.create');
    Route::post('admin/produk', [ProductController::class, 'store'])->name('produk.store');
    Route::get('admin/produk/{id}/edit', [ProductController::class, 'edit'])->name('produk.edit');
    Route::put('admin/produk/{id}', [ProductController::class, 'update'])->name('produk.update');
    Route::delete('admin/produk/{id}', [ProductController::class, 'destroy'])->name('produk.destroy');

    # Manage Customer
    Route::get('admin/customer', [UserController::class, 'index'])->name('customer.index');
    Route::get('admin/customer/create', [UserController::class, 'create'])->name('customer.create');
    Route::post('admin/customer', [UserController::class, 'store'])->name('customer.store');
    Route::get('admin/customer/{id}/edit', [UserController::class, 'edit'])->name('customer.edit');
    Route::put('admin/customer/{id}', [UserController::class, 'update'])->name('customer.update');
    Route::delete('admin/customer/{id}', [UserController::class, 'destroy'])->name('customer.destroy');

    # Proses Pengiriman Barang
    Route::get('/admin/pengirmiman', [ShippingController::class, 'index'])->name('admin.shipping');
    Route::post('/admin/pengirmiman/update/{id}', [ShippingController::class, 'updateStatus'])->name('admin.shipping.update');

    # Permohonan Pembukaan toko
    Route::get('permohonan-toko', [SellerRequestController::class, 'index'])->name('sellerRequests.index');
    Route::post('permohonan-toko/{id}/approve', [SellerRequestController::class, 'approve'])->name('sellerRequests.approve');
    Route::post('permohonan-toko/{id}/reject', [SellerRequestController::class, 'reject'])->name('sellerRequests.reject');
    Route::post('/permohonon-toko', [SellerRequestController::class, 'store'])->name('seller.request');

    # Customer
    # Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    # Tampilan Produk yang haya bisa dilihat customer yang sudah login
    Route::get('/produk/{id}', [ListController::class, 'show'])->name('produk.show');
    
    # Keranjang
    Route::post('/keranjang/add', [ListController::class, 'addToCart'])->name('cart.add');
    Route::get('/keranjang', [ListController::class, 'viewCart'])->name('keranjang.index');
    Route::delete('/keranjang/remove/{id}', [ListController::class, 'removeFromCart'])->name('cart.destroy');

    # Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/berhasil', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/{id}/print', [CheckoutController::class, 'print'])->name('checkout.print');
    
    # History  Checkout
    Route::get('/history', [CheckoutController::class, 'history'])->name('history.index');
    Route::post('/history/batal/{id}', [CheckoutController::class, 'cancel'])->name('history.cancel');
    
    # Halaman toko customer
    Route::get('/toko', [SellerRequestController::class, 'toko'])->name('seller.customer');
});
