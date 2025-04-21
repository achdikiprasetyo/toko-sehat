@extends('layouts.app')

@section('title')
    Detail Produk
@endsection

@section('content')
    <div class="container mt-5">
        <div class="row g-4">
            {{-- Gambar Produk --}}
            <div class="col-md-5">
                <div class="border rounded shadow-sm p-2 bg-white">
                    @if ($product->foto)
                        <img src="{{ asset('uploads/' . $product->foto) }}" class="img-fluid rounded" style="object-fit: cover; width: 100%; height: 400px;" alt="{{ $product->nama_produk }}">
                    @else
                        <div class="text-center text-muted py-5">Tidak ada gambar</div>
                    @endif
                </div>
            </div>

            {{-- Detail Produk --}}
            <div class="col-md-7">
                <h3 class="fw-bold">{{ $product->nama_produk }}</h3>

                <p class="text-muted mt-2"><i class="bi bi-tag"></i> <strong>Kategori:</strong> {{ $product->category->nama_kategori ?? '-' }}</p>

                <h4 class="text-danger fw-bold mb-3">Rp{{ number_format($product->harga) }}</h4>

                <p>{{ $product->deskripsi }}</p>

                <p><strong>Stok Tersedia:</strong> {{ $product->stock }}</p>

                {{-- Form Beli --}}
                <form action="{{ route('cart.add') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="d-flex align-items-center mb-3">
                        <label for="quantity" class="me-2 mb-0"><strong>Jumlah:</strong></label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1"
                            max="{{ $product->stock }}" class="form-control w-25" required>
                    </div>

                    <button type="submit" class="btn btn-success me-2">
                        <i class="bi bi-cart-plus"></i> Tambahkan ke Keranjang
                    </button>

                    <a href="{{ route('produk.list') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
