@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Toko Saya</h2>

    @if(Auth::user()->role !== 'seller')
        <div class="alert alert-info">
            Anda belum terdaftar sebagai seller.
        </div>
        <form action="{{ route('seller.request') }}" method="POST">
            @csrf
            <button class="btn btn-primary">Daftar sebagai Seller</button>
        </form>
    @else
        <div class="alert alert-success">
            Selamat! Anda adalah seller. 🎉
        </div>
        <!-- Tampilkan konten toko seller di sini -->
    @endif
</div>
@endsection
