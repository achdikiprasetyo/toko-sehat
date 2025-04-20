@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container">
    <h1>Checkout</h1>
    
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cartItems as $item)
                    @php
                        $subtotal = $item->quantity * $item->product->harga;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $item->product->nama_produk }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->product->harga) }}</td>
                        <td>Rp {{ number_format($subtotal) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4>Total: Rp {{ number_format($total) }}</h4>

        <div class="form-group mt-3">
            <label>Pilih Metode Pembayaran:</label><br>
            <select name="payment_method" class="form-control">
                <option value="paypal">PayPal</option>
                <option value="debit">Debit</option>
                <option value="cod">COD</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Checkout</button>
    </form>
</div>
@endsection
