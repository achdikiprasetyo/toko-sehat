@extends('layouts.app')

@section('title')
    Checkout
@endsection

@section('content')
    <div class="container mt-5">
        <h3 class="fw-bold mb-4">🧾 Checkout</h3>

        <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
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
                                <td><strong>{{ $item->product->nama_produk }}-{{ $item->product->id }}</strong></td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp {{ number_format($item->product->harga, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr class="fw-bold">
                            <td colspan="3" class="text-end">Subtotal</td>
                            <td id="subtotal-display">Rp {{ number_format($total, 0, ',', '.') }}</td>
                        </tr>
                        <tr class="fw-bold">
                            <td colspan="3" class="text-end">Ongkir</td>
                            <td id="ongkir-display">Rp 0</td>
                        </tr>
                        <tr class="fw-bold">
                            <td colspan="3" class="text-end">Total Bayar</td>
                            <td id="total-display">Rp {{ number_format($total, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Lokasi dan Metode Pembayaran --}}
            <div class="mt-4">
                <label for="lokasi" class="form-label fw-semibold">Pilih Lokasi Pengiriman:</label>
                <select name="lokasi" id="lokasi" class="form-select w-50" required onchange="updateOngkir()">
                    <option value="" disabled selected>-- Pilih Lokasi --</option>
                    <option value="surabaya">Surabaya</option>
                    <option value="jawa">Luar Surabaya (Masih Jawa)</option>
                    <option value="luar_jawa">Luar Jawa</option>
                </select>
            </div>

            <input type="hidden" name="ongkir" id="ongkir" value="0">

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

    {{-- Script Update Ongkir & Total --}}
    <script>
        function updateOngkir() {
            const lokasi = document.getElementById('lokasi').value;
            const subtotal = {{ $total }};
            let ongkir = 0;

            if (lokasi === 'surabaya') {
                ongkir = 1000;
            } else if (lokasi === 'jawa') {
                ongkir = 15000;
            } else if (lokasi === 'luar_jawa') {
                ongkir = 30000;
            }

            const totalBayar = subtotal + ongkir;

            document.getElementById('ongkir').value = ongkir;
            document.getElementById('ongkir-display').textContent = 'Rp ' + ongkir.toLocaleString('id-ID');
            document.getElementById('total-display').textContent = 'Rp ' + totalBayar.toLocaleString('id-ID');
        }
    </script>
@endsection
