@extends('layouts.app')

@section('title')
    Checkout
@endsection

@section('content')
    <div class="container mt-5">
        <h3 class="fw-bold mb-4">🧾 Checkout</h3>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga Satuan</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($cartItems as $item)
                            @php
                                $subtotal = $item->quantity * $item->product->harga;
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td>
                                    <strong>{{ $item->product->nama_produk }}-{{ $item->product->id }}</strong><br>
                                </td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp {{ number_format($item->product->harga, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr class="fw-bold">
                            <td colspan="3" class="text-end">Total</td>
                            <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <label for="payment_method" class="form-label fw-semibold">Pilih Metode Pembayaran:</label>
                <select name="payment_method" id="payment_method" class="form-select w-50" required>
                    <option value="" disabled selected>-- Pilih Metode --</option>
                    <option value="paypal">PayPal</option>
                    <option value="debit">Debit</option>
                    <option value="cod">Cash on Delivery</option>
                </select>
            </div>

            <div class="mt-4 text-start">
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="bi bi-cart-check"></i> Proses Checkout
                </button>
            </div>
        </form>
    </div>
@endsection
