<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{   
    // Menampilkan semua produk dan kategori
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        $categories = Category::all();

        return view('product.list', compact('products', 'categories'));
    }
    
    // Filter produk berdasarkan kategori
    public function produkByKategori($id)
    {
        $products = Product::where('kategori_id', $id)->get();
        $categories = Category::all();
        $selectedCategory = Category::findOrFail($id);
 
        return view('product.list', compact('products', 'categories', 'selectedCategory'));
    }

    // Menampilkan info lengkap produk
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product.view', compact('product'));
    }

    // Tambah produk ke keranjang
    public function addToCart(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $product = Product::findOrFail($request->product_id);

            $existingCart = Cart::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->first();

            if ($existingCart) {
                $existingCart->quantity += $request->quantity;
                $existingCart->save();
            } else {
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                ]);
            }

            return redirect()->route('keranjang.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
        }

        return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
    }

    // Menampilkan isi keranjang
    public function viewCart()
    {
        $user = Auth::user();
        $carts = Cart::with('product')->where('user_id', $user->id)->get();

        return view('keranjang.index', compact('carts'));
    }

    // Menghapus produk dari keranjang
    public function removeFromCart($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }


}
