@extends('layouts.app')

@section('title')
    Keranjang Belanja
@endsection

@section('content')
    <div class="container mt-4">
        <h2>Keranjang Belanja Saya</h2>

        @if ($carts->isEmpty())
            <div class="alert alert-info">
                Keranjang kamu kosong 
            </div>
        @else
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp

                    @foreach ($carts as $cart)
                        @php
                            // Hitung total per item berdasarkan harga dan jumlah
                            $total = $cart->product->harga * $cart->quantity;
                            $grandTotal += $total; // Menambahkan total item ke grand total
                        @endphp
                        <tr>
                            <td>{{ $cart->product->nama_produk }}</td>
                            <td>Rp {{ number_format($cart->product->harga, 0, ',', '.') }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.destroy', $cart->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus item ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <th colspan="3">Total Keseluruhan</th>
                        <th colspan="2">Rp {{ number_format($grandTotal, 0, ',', '.') }}</th>
                    </tr>
                </tbody>
            </table>


            <div class="text-end">
                <<a href="{{ route('checkout.index') }}" class="btn btn-success">Checkout Sekarang</a>

            </div>
        @endif
    </div>
@endsection
