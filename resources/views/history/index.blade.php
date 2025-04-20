@extends('layouts.app')

@section('title')
    Riwayat Pembelian
@endsection

@section('content')
    <div class="container mt-4">
        <h2>Riwayat Pembelian</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @forelse($orders as $order)
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between">
                    <span><strong>Tanggal:</strong> {{ $order->created_at->format('d-m-Y H:i:s') }}</span>
                    <span>
                        <strong>Status:</strong>
                        @if ($order->status === 'dikemas')
                            <span class="badge bg-warning text-dark">Dikemas</span>
                        @elseif ($order->status === 'dikirim')
                            <span class="badge bg-primary">Dikirim</span>
                        @elseif ($order->status === 'diterima')
                            <span class="badge bg-success">Diterima</span>
                        @elseif ($order->status === 'dibatalkan')
                            <span class="badge bg-danger">Dibatalkan</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                        @endif
                    </span>
                    
                </div>
                <div class="card-body">
                    <ul class="list-group mb-3">
                        @foreach ($order->items as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $item->product->nama_produk }}</strong><br>
                                    Jumlah: {{ $item->quantity }}
                                </div>
                                <span>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <h5 class="text-end">Total: Rp {{ number_format($order->total, 0, ',', '.') }}</h5>

                    @if ($order->status === 'dikemas')
                        <form action="{{ route('history.cancel', $order->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                            @csrf
                            <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="alert alert-info">Belum ada riwayat pembelian.</div>
        @endforelse
    </div>
@endsection
