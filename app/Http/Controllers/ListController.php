<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    public function index()
    {
        // Ambil semua produk beserta kategori
        $products = Product::with('category')->latest()->get();
        // Ambil semua kategori
        $categories = Category::all();
    
        // Kirimkan data produk dan kategori ke view
        return view('product.list', compact('products', 'categories'));
    }
    
    public function produkByKategori($id)
    {
        // Ambil produk berdasarkan kategori
        $products = Product::where('kategori_id', $id)->get();
        // Ambil semua kategori
        $categories = Category::all();
    
        // Kirimkan data produk dan kategori ke view
        return view('product.list', compact('products', 'categories'));
    }

    // Menampilkan detail produk
    public function show($id)
    {
        // Ambil produk berdasarkan ID
        $product = Product::findOrFail($id);

        return view('product.view', compact('product'));
    }

    public function addToCart(Request $request)
    {
        // Cek apakah user sudah login
        if (Auth::check()) {
            $user = Auth::user();
            $product = Product::findOrFail($request->product_id);

            // Cek apakah produk sudah ada di keranjang
            $existingCart = Cart::where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->first();

            if ($existingCart) {
                // Jika ada, update quantity
                $existingCart->quantity += $request->quantity;
                $existingCart->save();
            } else {
                // Jika belum ada, buat item baru di keranjang
                Cart::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                ]);
            }

            return redirect()->route('keranjang.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
        }

        // Jika user belum login
        return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
    }


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
