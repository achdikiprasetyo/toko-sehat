@extends('layouts.app')

@section('title')  {{-- Typo diperbaiki --}}
    Edit Produk
@endsection

@section('content')
<div class="container">
    <h1>Edit Produk</h1>

    <form action="{{ route('produk.update', $product->id) }}" method="POST" enctype="multipart/form-data"> {{-- enctype diperlukan untuk upload file --}}
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control"
                value="{{ old('nama_produk', $product->nama_produk) }}">
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ old('harga', $product->harga) }}">
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $product->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $kategori)
                    <option value="{{ $kategori->id }}"
                        {{ old('kategori_id', $product->kategori_id) == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Foto Produk</label>
            <input type="file" name="foto" class="form-control">
            @if($product->foto)
                <p class="mt-2">Foto saat ini:</p>
                <img src="{{ asset('uploads/' . $product->foto) }}" alt="Foto Produk" width="150">
            @endif
        </div>

        <button type="submit" class="btn btn-success">Simpan Perbahan</button>
    </form>
</div>
@endsection
