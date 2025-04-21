@extends('layouts.admin')

@section('title')
    Ulasan Customer
@endsection 

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold">Semua Ulasan</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0 align-middle">
                <thead class="table-light text-center">
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
                    @forelse ($reviews as $review)
                        <tr>
                            <td>{{ $review->user->username }}</td>
                            <td>#{{ $review->checkout->id }}</td>
                            <td class="text-center">
                                <span class="badge bg-warning text-dark">{{ $review->rating }} / 5</span>
                            </td>
                            <td>{{ $review->review }}</td>
                            <td>{{ $review->created_at->format('d-m-Y H:i') }}</td>
                            <td class="text-center">
                                <form action="{{ route('ulasan.destroy', $review->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada ulasan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
