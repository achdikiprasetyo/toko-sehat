@extends('layouts.app')

@section('title')
    Masuk Toko Sehat
@endsection

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Login</h2>
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username"
                    required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password"
                    required>
            </div>

            <div class="d-flex justify-content-center ">

                <div class="d-flex flex-column ">
                    <button type="submit" class="btn btn-primary mb-2">Masuk</button>

                    <p>Anda belum memiliki akun? <a href="{{ route('register') }}" class="btn btn-link">Daftar</a></p>
                </div>
            </div>
        </form>
    </div>
@endsection
