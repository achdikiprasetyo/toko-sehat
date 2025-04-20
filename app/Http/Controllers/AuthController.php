<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Menampilkan halaman registrasi
    public function showRegister()
    {
        return view('autentikasi.register');
    }

    // Proses registrasi
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'dob' => 'required|date',
            'gender' => 'required|in:L,P',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dob' => $request->dob,
            'gender' => $request->gender,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    // Menampilkan halaman login
    public function showLogin()
    {
        return view('autentikasi.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate(); 
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login sebagai administrator berhasil!');
            } else {
                return redirect()->route('welcome')->with('success', 'Login berhasil!');
            }
        }

        return back()->withErrors(['username' => 'Username atau password yang Anda masukkan salah!']);
    }

    // Logout user
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('welcome')->with('success', 'Berhasil logout.');
    }
}
