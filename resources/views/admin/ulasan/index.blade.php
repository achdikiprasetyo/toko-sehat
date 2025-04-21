@extends('layouts.admin')

@section('title')
    Ulasan Customer
@endsection 

@section('content')
<div class="container mt-4">
    <h3>Semua Ulasan</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Pengguna</th>
                <th>Produk / Order</th>
                <th>Rating</th>
                <th>Ulasan</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review->user->username }}</td>
                    <td>#{{ $review->checkout->id }}</td>
                    <td>{{ $review->rating }} / 5</td>
                    <td>{{ $review->review }}</td>
                    <td>{{ $review->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <form action="{{ route('ulasan.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            @if($reviews->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">Belum ada ulasan.</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
