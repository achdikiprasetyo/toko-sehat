<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{   
    // Menampilkan informasi customer
    public function index()
    {
        $user = Auth::user();
        return view('customer.profile', compact('user'));
    }
}
