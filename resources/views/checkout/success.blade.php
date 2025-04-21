@extends('layouts.app')

@section('title')
    Berhasil Checkout
@endsection

@section('content')
    <div class="container mt-5">
        <div class="alert alert-success shadow-sm rounded">
            <h4 class="mb-1">Checkout Berhasil!</h4>
            <p class="mb-0">Terima kasih telah berbelanja di <strong>Toko Sehat Online</strong>.</p>
        </div>

        <div class="card shadow-sm mt-4">
            <div class="card-body">
                <h5 class="card-title mb-3">Laporan Pembelian</h5>

                <div class="card mb-4 border-0 bg-light">
                    <div class="card-body">
                        <h6 class="card-title fw-bold">Informasi Penerima</h6>
                        <p class="mb-1"><strong>Nama:</strong> {{ $checkout->user->username }}</p>
                        <p class="mb-1"><strong>Alamat:</strong> {{ $checkout->user->address }}</p>
                        <p class="mb-0"><strong>No. HP:</strong> {{ $checkout->user->phone }}</p>
                    </div>
                </div>

                <p><strong>Metode Pembayaran:</strong> {{ ucfirst($checkout->payment_method) }}</p>
                <p><strong>Tanggal Transaksi:</strong> {{ $checkout->created_at->format('d-m-Y H:i:s') }}</p>
                <p><strong>Status:</strong>
                    <span class="badge bg-success">{{ ucfirst($checkout->status) }}</span>
                </p>

                <hr>

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
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
                                    <td>
                                        <strong>{{ $item->product->nama_produk }}-{{ $item->product->id }}</strong><br>

                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <h5 class="text-end mt-3">Total: <span class="text-success">Rp
                        {{ number_format($checkout->total, 0, ',', '.') }}</span></h5>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ route('checkout.print', $checkout->id) }}" class="btn btn-outline-danger" target="_blank">
                Cetak PDF
            </a>

            <a href="{{ route('keranjang.index') }}" class="btn btn-primary">
                Kembali ke Toko
            </a>
        </div>
    </div>
@endsection
