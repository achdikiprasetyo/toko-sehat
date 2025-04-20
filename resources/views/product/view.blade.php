@extends('layouts.app')

@section('title')
    Detail Produk
@endsection

@section('content')
    <div class="container mt-4">
        <div class="row d-flex align-items-start">
            <div class="col-md-4">
                @if ($product->foto)
                    <div
                        style="width: 100%; padding-top: 100%; position: relative; background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 8px;">
                        <img src="{{ asset('uploads/' . $product->foto) }}" alt="{{ $product->nama_produk }}"
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                    </div>
                @else
                    <div class="text-muted">Tidak ada gambar</div>
                @endif
            </div>

            <div class="col-md-8">
                <h2 class="mb-3">{{ $product->nama_produk }}</h2>
                <p><strong>Deskripsi:</strong> {{ $product->deskripsi }}</p>
                <p><strong>Harga:</strong> Rp{{ number_format($product->harga) }}</p>
                <p><strong>Kategori:</strong> {{ $product->categorys->nama_kategori ?? '-' }}</p>
                <p><strong>Stok:</strong> {{ $product->stock }}</p>

                <div class="mt-4">
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <label for="quantity" class="form-label"><strong>Jumlah Beli</strong></label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1"
                            max="{{ $product->stock }}" class="form-control w-25 mb-2" required>

                        <button type="submit" class="btn btn-success">Beli Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
