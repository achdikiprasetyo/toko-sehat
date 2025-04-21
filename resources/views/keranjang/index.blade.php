@extends('layouts.app')

@section('title')
    Keranjang Belanja
@endsection

@section('content')
    <div class="container mt-5">
        <h3 class="mb-4 fw-bold"> Keranjang Belanja Saya</h3>

        @if ($carts->isEmpty())
            <div class="alert alert-info">
                Keranjang kamu kosong. Yuk belanja dulu!
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $grandTotal = 0; @endphp

                        @foreach ($carts as $cart)
                            @php
                                $total = $cart->product->harga * $cart->quantity;
                                $grandTotal += $total;
                            @endphp
                            <tr>
                                <td>
                                    <strong>{{ $cart->product->nama_produk }}-{{ $cart->product->id }}</strong><br>
                                </td>
                                <td>Rp {{ number_format($cart->product->harga, 0, ',', '.') }}</td>
                                <td>{{ $cart->quantity }}</td>
                                <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('cart.destroy', $cart->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin hapus item ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        <tr class="fw-bold">
                            <td colspan="3" class="text-end">Total Keseluruhan</td>
                            <td colspan="2">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-end mt-3">
                <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg">
                    <i class="bi bi-credit-card"></i> Checkout Sekarang
                </a>
            </div>
        @endif
    </div>
@endsection
