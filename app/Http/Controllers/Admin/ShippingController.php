<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;

class ShippingController extends Controller
{   
    // Menampilkan semua pengiriman 
    public function index()
    {   
        
        $orders = Checkout::with('user', 'items.product')->orderBy('created_at', 'desc')->get();
        return view('admin.shipping.index', compact('orders'));
    }

    // Update status pengiriman
    public function updateStatus(Request $request, $id)
    {
        $order = Checkout::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Status pengiriman berhasil diperbaruhi');
    }
}
