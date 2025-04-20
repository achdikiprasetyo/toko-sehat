@extends('layouts.admin')

@section('titile')
    Tambah Kategori
@endsection

@section('content')
<div class="container">
    <h4 class="mb-4">Tambah Kategori</h4>

    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
            @error('nama_kategori')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
