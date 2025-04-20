@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar kategori -->
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">
                        <strong>Pilih Kategori</strong>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($categories as $kategori)
                                <li class="list-group-item">
                                    <a
                                        href="{{ route('produk.byKategori', $kategori->id) }}">{{ $kategori->nama_kategori }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Daftar produk -->
            <div class="col-md-10">
                <div class="row">
                    @forelse ($products as $product)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                @if ($product->foto)
                                    <img src="{{ asset('uploads/' . $product->foto) }}" alt="{{ $product->nama_produk }}"
                                        width="80">
                                @else
                                    <span class="text-muted">Tidak ada</span>
                                @endif
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $product->nama_produk }}</h5>
                                    <p class="card-text">{{ Str::limit($product->deskripsi, 100) }}</p>
                                    <p class="card-text"><strong>Rp{{ number_format($product->harga) }}</strong></p>
                                    <div class="mt-auto d-flex justify-content-between">
                                        <a href="{{ route('produk.show', $product->id) }}"
                                            class="btn btn-primary btn-sm">Lihat</a>

                                        {{-- <form action="{{ route('cart.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-success btn-sm">Beli</button>
                                        </form> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">Tidak ada produk tersedia.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
