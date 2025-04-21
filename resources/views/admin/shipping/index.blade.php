@extends('layouts.admin')

@section('title')
    Pengiriman Produk
@endsection

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold">Manajemen Pengiriman Produk</h3>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th>Nama Customer</th>
                        <th>Produk</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Ubah Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->user->username }}</td>
                            <td>
                                <ul class="mb-0">
                                    @foreach ($order->items as $item)
                                        <li>{{ $item->product->nama_produk }} x {{ $item->quantity }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <span class="badge 
                                    @if($order->status === 'dikemas') bg-warning 
                                    @elseif($order->status === 'dikirim') bg-info 
                                    @elseif($order->status === 'diterima') bg-success 
                                    @else bg-secondary 
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td>
                                @if ($order->status !== 'diterima')
                                    <form action="{{ route('admin.shipping.update', $order->id) }}" method="POST">
                                        @csrf
                                        <div class="d-flex gap-2">
                                            <select name="status" class="form-select form-select-sm">
                                                <option value="dikemas" {{ $order->status === 'dikemas' ? 'selected' : '' }}>Dikemas</option>
                                                <option value="dikirim" {{ $order->status === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                                <option value="diterima" {{ $order->status === 'diterima' ? 'selected' : '' }}>Diterima</option>
                                            </select>
                                            <button class="btn btn-sm btn-success">Update</button>
                                        </div>
                                    </form>
                                @else
                                    <div class="text-success text-center">✔️ Diterima</div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada pesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
