@extends('layouts.admin')

@section('titile')
    Manajemen Kategori Produk
@endsection

@section('content')

<div class="container">
    <h4 class="mb-4">Daftar Kategori</h4>

    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">+ Tambah Kategori</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $index => $category)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $category->nama_kategori }}</td>
                <td>
                    <a href="{{ route('kategori.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('kategori.destroy', $category->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
            
            @if($categories->isEmpty())
            <tr>
                <td colspan="3" class="text-center">Belum ada kategori.</td>
            </tr>
            @endif
            
@endsection

