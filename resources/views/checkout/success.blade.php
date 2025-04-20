@extends('layouts.app')

@section('title')
    Berhasil Checkout
@endsection

@section('content')
    <div class="container mt-4">
        <div class="alert alert-success">
            <h4>Checkout Berhasil!</h4>
            <p>Terima kasih telah berbelanja di Toko Sehat Online</p>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Laporan Pembelian</h5>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Informasi Penerima</h5>
                        <p><strong>Nama:</strong> {{ $checkout->user->username }}</p>
                        <p><strong>Alamat:</strong> {{ $checkout->user->address }}</p>
                        <p><strong>No. HP:</strong> {{ $checkout->user->phone }}</p>
                    </div>
                </div>
                <p><strong>Metode Pembayaran:</strong> {{ ucfirst($checkout->payment_method) }}</p>
                <p><strong>Tanggal Transaksi:</strong> {{ $checkout->created_at->format('d-m-Y H:i:s') }}</p>
                <p><strong>Status:</strong> {{ ucfirst($checkout->status) }}</p>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($checkout->items as $item)
                            <tr>
                                <td>{{ $item->product->nama_produk }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <h5 class="text-end">Total: Rp {{ number_format($checkout->total, 0, ',', '.') }}</h5>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('checkout.print', $checkout->id) }}" class="btn btn-outline-danger" target="_blank">
                🧾 Cetak PDF
            </a>
        </div>

        <div class="mt-4">
            <a href="{{ route('keranjang.index') }}" class="btn btn-primary">Kembali ke Toko</a>
        </div>
    </div>
@endsection
