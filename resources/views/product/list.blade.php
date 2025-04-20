@extends('layouts.app')

@section('title')
    Daftar Produk
@endsection

@section('content')
<div class="container-fluid">
    <h2 class="mt-4 mb-4 text-center fw-bold"> Daftar Produk - Toko Sehat Online</h2>

    @if (isset($selectedCategory))
            Menampilkan produk untuk kategori: <strong>{{ $selectedCategory->nama_kategori }}</strong>
    @endif

    <div class="row">
        {{-- Daftar Produk --}}
        <div class="col-md-10">
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            @if ($product->foto)
                                <img src="{{ asset('uploads/' . $product->foto) }}" alt="{{ $product->nama_produk }}"
                                    class="card-img-top" style="height: 200px; object-fit: cover;">
                            @else
                                <span class="text-muted text-center p-3">Tidak ada gambar</span>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->nama_produk }}</h5>
                                <p class="card-text">{{ Str::limit($product->deskripsi, 100) }}</p>
                                <p class="card-text"><strong>Rp{{ number_format($product->harga) }}</strong></p>
                                <div class="mt-auto d-flex justify-content-between">
                                    <a href="{{ route('produk.show', $product->id) }}"
                                        class="btn btn-primary btn-sm">Lihat</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Tidak ada produk tersedia.</p>
                @endforelse
            </div>
        </div>

        {{-- Kategori di sebelah kanan --}}
        <div class="col-md-2">
            <div class="card">
                <div class="card-header text-center">
                    <strong>Kategori</strong>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @foreach ($categories as $kategori)
                            <li class="list-group-item text-center">
                                <a href="{{ route('produk.byKategori', $kategori->id) }}">
                                    {{ $kategori->nama_kategori }}
                                </a>
                            </li>
                        @endforeach
                        <li class="list-group-item text-center">
                            <a href="{{ route('produk.list') }}" class="text-secondary">Tampilkan Semua</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
