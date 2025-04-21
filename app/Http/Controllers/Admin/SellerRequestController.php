<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SellerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerRequestController extends Controller
{   
    // Menampilkan halaman admin pembukaan toko
    public function index()
    {
        $requests = SellerRequest::with('user')->get();
        return view('admin.sellerRequest.index', compact('requests'));
    }
    
    // Menyimpan pembukaan toko
    public function store(Request $request)
    {
        $user = Auth::user();

        // Cek apakah sudah pernah mengajukan
        if (SellerRequest::where('user_id', $user->id)->where('status', 'pending')->exists()) {
            return back()->with('error', 'Anda sudah mengajukan permintaan menjadi seller.');
        }

        SellerRequest::create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Permintaan menjadi seller telah dikirim.');
    }

    // Ubah role jika disetujui
    public function approve($id)
    {
        $request = SellerRequest::findOrFail($id);
        $request->status = 'approved';
        $request->save();

        // Update role 
        $user = $request->user;
        $user->role = 'seller';
        $user->save();

        return redirect()->route('sellerRequests.index')->with('success', 'Permintaan pembukaan toko disetujui');
    }

    // Menolak pembuatan toko
    public function reject($id)
    {
        $request = SellerRequest::findOrFail($id);
        $request->status = 'rejected';
        $request->save();

        return redirect()->route('sellerRequests.index')->with('success', 'Permintaan pembukaan toko ditolak');
    }

    public function toko()
    {
        // Cek apakah user sudah terdaftar sebagai seller

            return view('toko.index');

    }
}
