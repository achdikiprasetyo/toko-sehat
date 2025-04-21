<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{   
    // Menampilkan semua akun customer
    public function index()
    {
        $users = User::all();
        return view('admin.customer.index', compact('users'));
    }

    // Form tambah user
    public function create()
    {
        return view('admin.customer.create');
    }

    // Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'dob' => 'required|date',
            'gender' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('customer.index')->with('success', 'Pembuatan Akun Berhasil');
    }

    // Form edit
    public function edit(User $user)
    {
        return view('admin.customer.edit', compact('user'));
    }

    // Edit data user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'dob' => 'required|date',
            'gender' => 'required',
            'address' => 'required',
            'city' => 'required',
            'phone' => 'required',
        ]);

        $user->username = $request->username;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->dob = $request->dob;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('customer.index')->with('success', 'Berhasil Memperbarui Akun');
    }

    // Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('customer.index')->with('success', 'Akun berhasil di hapus');
    }
}
