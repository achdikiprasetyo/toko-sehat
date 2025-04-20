<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\CheckoutItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('checkout.index', compact('cartItems'));
    }

    public function process(Request $request)
    {


        DB::beginTransaction();

        try {
            $user = Auth::user();
            $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item->product->harga * $item->quantity;
            }

            // Simpan checkout
            $checkout = Checkout::create([
                'user_id' => $user->id,
                'total' => $total,
                'status' => 'dikemas'
            ]);

            foreach ($cartItems as $item) {
                // Kurangi stok produk
                $product = $item->product;
                $product->stock -= $item->quantity;
                $product->save();

                // Simpan detail item checkout
                CheckoutItem::create([
                    'checkout_id' => $checkout->id,
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'price' => $product->harga
                ]);
            }

            // Kosongkan keranjang
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()->route('checkout.success')->with('success', 'Checkout berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }

    public function success()
    {
        $user = Auth::user(); // Mengambil data pengguna yang sedang login
        $checkout = Checkout::with(['user', 'items.product']) // Ambil data checkout dan relasinya
            ->where('user_id', $user->id) // Pastikan hanya milik user yang sedang login
            ->latest() // Ambil data checkout terbaru
            ->first(); // Ambil yang pertama

        // Jika tidak ada data checkout, redirect ke halaman keranjang
        if (!$checkout) {
            return redirect()->route('keranjang.index')->with('error', 'Checkout tidak ditemukan.');
        }

        return view('checkout.success', compact('checkout'));
    }

    public function history()
    {
        $orders = Checkout::with(['items.product'])
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('history.index', compact('orders'));
    }

    public function cancel($id)
    {
        $order = Checkout::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'dikemas')
            ->firstOrFail();

        // Hapus item-item terkait terlebih dahulu
        $order->items()->delete();

        // Hapus checkout utama
        $order->delete();

        return redirect()->route('history.index')->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function print($id)
    {
        $checkout = Checkout::with(['items.product', 'user'])->findOrFail($id);

        $pdf = Pdf::loadView('checkout.print', compact('checkout'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-pembelian.pdf');
    }
}
