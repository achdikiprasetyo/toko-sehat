@extends('layouts.app')

@section('title')
    Masuk Toko Sehat Online
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container mt-5" style="max-width: 400px;">
        <h2 class="text-center mb-4">Login</h2>
        <div class="text-center mb-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Toko Sehat Online" class="img-fluid" style="max-height: 100px;">
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan!</strong>
                <ul class="mb-0 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                    id="username" placeholder="Masukkan username" required value="{{ old('username') }}">
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    id="password" placeholder="Masukkan password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-center">
                <div class="d-flex flex-column">
                    <button type="submit" class="btn btn-primary mb-2">Masuk</button>
                    <p>Anda belum memiliki akun? <a href="{{ route('register') }}" class="btn btn-link">Daftar</a></p>
                </div>
            </div>
        </form>
    </div>
@endsection
