<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Checkout;
use App\Models\CheckoutItem;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckoutController extends Controller
{
    // Menampilkan keranjang
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('checkout.index', compact('cartItems'));
    }

    // Menyimpan item keranjang di checkout
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

            $checkout = Checkout::create([
                'user_id' => $user->id,
                'total' => $total,
                'status' => 'dikemas',
                'payment_method' => $request->payment_method
            ]);

            foreach ($cartItems as $item) {
                // Kurangi stok 
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

            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()->route('checkout.success')->with('success', 'Checkout berhasil!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }

    // Menampilkan hasil checkout
    public function success()
    {
        $user = Auth::user();
        // Mengambil data chechout yang terakhir kali
        $checkout = Checkout::with(['user', 'items.product'])
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        // Jika tidak ada data checkout, redirect ke halaman keranjang
        if (!$checkout) {
            return redirect()->route('keranjang.index')->with('error', 'Checkout tidak ditemukan.');
        }

        return view('checkout.success', compact('checkout'));
    }

    // History pembelian user
    public function history()
    {
        $orders = Checkout::with(['items.product'])
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('history.index', compact('orders'));
    }

    // Kirim ulasan
    public function submit(Request $request)
    {
        $request->validate([
            'checkout_id' => 'required|exists:checkouts,id',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'checkout_id' => $request->checkout_id,
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim!');
    }

    // Pembatalan order
    public function cancel($id)
    {
        $order = Checkout::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'dikemas')
            ->firstOrFail();
        $order->items()->delete();
        $order->delete();

        return redirect()->route('history.index')->with('success', 'Pesanan berhasil dibatalkan.');
    }

    // Cetak pdf histoy pembelian
    public function print($id)
    {
        $checkout = Checkout::with(['items.product', 'user'])->findOrFail($id);

        $pdf = Pdf::loadView('checkout.print', compact('checkout'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('laporan-pembelian.pdf');
    }
}
