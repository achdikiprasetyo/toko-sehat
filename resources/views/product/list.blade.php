@extends('layouts.app')

@section('title')
    Daftar Produk
@endsection

@section('content')
    <div class="container-fluid py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2 class="text-center fw-bold mb-4"> Daftar Produk - Toko Sehat Online</h2>

        @if (isset($selectedCategory))
            <div class="alert alert-info text-center">
                Menampilkan produk untuk kategori: <strong>{{ $selectedCategory->nama_kategori }}</strong>
            </div>
        @endif

        <div class="row">
            {{-- Daftar Produk --}}
            <div class="col-md-10">
                <div class="row">
                    @forelse ($products as $product)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100 shadow-sm">
                                @if ($product->foto)
                                    <img src="{{ asset('uploads/' . $product->foto) }}" alt="{{ $product->nama_produk }}"
                                        class="card-img-top" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="d-flex align-items-center justify-content-center"
                                        style="height: 200px; background-color: #f8f9fa;">
                                        <span class="text-muted">Tidak ada gambar</span>
                                    </div>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $product->nama_produk }}</h5>
                                    <p class="card-text text-muted">{{ Str::limit($product->deskripsi, 30) }}</p>
                                    <p class="card-text fw-bold text-success">Rp
                                        {{ number_format($product->harga, 0, ',', '.') }}</p>
                                    <div class="mt-auto text-end">
                                        <a href="{{ route('produk.show', $product->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning text-center">Tidak ada produk tersedia saat ini.</div>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Sidebar Kategori Sebelah Kanan --}}
            <div class="col-md-2 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-primary text-white">
                        <strong>Kategori</strong>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach ($categories as $kategori)
                                <li
                                    class="list-group-item text-center {{ isset($selectedCategory) && $selectedCategory->id === $kategori->id ? 'active bg-secondary text-white' : '' }}">
                                    <a href="{{ route('produk.byKategori', $kategori->id) }}"
                                        class="text-decoration-none {{ isset($selectedCategory) && $selectedCategory->id === $kategori->id ? 'text-white fw-bold' : 'text-dark' }}">
                                        {{ $kategori->nama_kategori }}
                                    </a>
                                </li>
                            @endforeach
                            <li
                                class="list-group-item text-center {{ !isset($selectedCategory) ? 'active bg-secondary text-white' : '' }}">
                                <a href="{{ route('produk.list') }}"
                                    class="text-decoration-none {{ !isset($selectedCategory) ? 'text-white fw-bold' : 'text-secondary' }}">
                                    Tampilkan Semua
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
