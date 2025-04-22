<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pembelian</title>
    <style>
        body { font-family: sans-serif; }
        .container { padding: 20px; }
        .text-right { text-align: right; }
        .signature {
            position: absolute;
            bottom: 50px;
            right: 50px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Laporan Pembelian</h2>
        <p><strong>Nama:</strong> {{ $checkout->user->username }}</p>
        <p><strong>Alamat:</strong> {{ $checkout->user->address }}</p>
        <p><strong>No. HP:</strong> {{ $checkout->user->phone }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ ucfirst($checkout->payment_method) }}</p>
        <p><strong>Tanggal Transaksi:</strong> {{ $checkout->created_at->format('d-m-Y H:i:s') }}</p>

        <table width="100%" border="1" cellspacing="0" cellpadding="5" style="margin-top:20px;">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $subtotal = 0; @endphp
                @foreach ($checkout->items as $item)
                    @php
                        $itemSubtotal = $item->price * $item->quantity;
                        $subtotal += $itemSubtotal;
                    @endphp
                    <tr>
                        <td>{{ $item->product->nama_produk }} - {{ $item->product->id }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($itemSubtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Ringkasan Harga --}}
        <div style="margin-top: 20px;">
            <h4 class="text-right">Subtotal: Rp {{ number_format($subtotal, 0, ',', '.') }}</h4>
            <h4 class="text-right">Ongkir: Rp {{ number_format($checkout->ongkir, 0, ',', '.') }}</h4>
            <h3 class="text-right">Total Bayar: Rp {{ number_format($checkout->total, 0, ',', '.') }}</h3>
        </div>

        <div class="signature">
            <p>Hormat Kami,</p>
            <br><br>
            <strong>Toko Sehat Online</strong>
        </div>
    </div>
</body>
</html>
