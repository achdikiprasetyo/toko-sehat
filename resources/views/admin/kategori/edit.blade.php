@extends('layouts.admin')

@section('titile')
    Edit Kategori
@endsection
@section('content')
<div class="container">
    <h4 class="mb-4">Edit Kategori</h4>

    <form action="{{ route('kategori.update', $categorys->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" value="{{ $categorys->nama_kategori }}" class="form-control" required>
            @error('nama_kategori')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection
