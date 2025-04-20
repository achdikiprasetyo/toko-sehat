@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Daftar Produk</h1>
    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stock</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>
                    @if($product->foto)
                        <img src="{{ asset('uploads/' . $product->foto) }}" alt="{{ $product->nama_produk }}" width="80">
                    @else
                        <span class="text-muted">Tidak ada</span>
                    @endif
                </td>
                <td>{{ $product->nama_produk }}</td>
                <td>Rp{{ number_format($product->harga) }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->categorys->nama_kategori ?? '-' }}</td>
                <td>
                    <a href="{{ route('produk.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('produk.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
