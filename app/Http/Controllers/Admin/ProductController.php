<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{   
    // Menampilkan semua produk
    public function index()
    {
        $products = Product::all();
        return view('admin.produk.index', compact('products'));
    }

    // Form pembuatan produk
    public function create()
    {
        $categories = Category::all();
        return view('admin.produk.create', compact('categories'));
    }

    // Simpan 
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stock' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:categories,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $data = $request->all();
        
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['foto'] = $filename;
        }
        
        Product::create($data);
        
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    // Menampilkan form edit
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.produk.edit', compact('product', 'categories'));
    }
    
    // Edit 
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stock' => 'required|integer',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:categories,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('foto');

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            if ($product->foto && file_exists(public_path('uploads/' . $product->foto))) {
                unlink(public_path('uploads/' . $product->foto));
            }

            $filename = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('uploads'), $filename);
            $data['foto'] = $filename;
        }

        $product->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    // Hapus produk
    public function destroy($id)
    {   
        // Menghapus produk
        $product = Product::findOrFail($id);
        if ($product->foto && file_exists(public_path('uploads/' . $product->foto))) {
            unlink(public_path('uploads/' . $product->foto));
        }

        $product->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
