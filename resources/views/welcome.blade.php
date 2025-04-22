@extends('layouts.app')

@section('title')
    Toko Sehat Online
@endsection

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="d-flex justify-content-center align-items-start" style="min-height: 100vh;">
        <div class="text-center mt-5">
            <h1 class="display-4 fw-bold">Toko Sehat Online</h1>
            <p class="lead">Solusi belanja sehat, praktis, dan terpercaya! </p>

            <a href="{{ route('produk.list') }}" class="btn btn-success btn-lg mt-3">
                Beli Sekarang
            </a>
        </div>
    </div>
@endsection
