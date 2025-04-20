@extends('layouts.admin')

@section('title', 'Shipping Management')

@section('content')
    <div class="container mt-4">
        <h3>Shipping Management</h3>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Products</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Change Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->user->username }}</td>
                        <td>
                            <ul>
                                @foreach ($order->items as $item)
                                    <li>{{ $item->product->nama_produk }} x {{ $item->quantity }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        <td><span class="badge bg-primary">{{ ucfirst($order->status) }}</span></td>
                        <td>
                            @if ($order->status !== 'diterima')
                                <form action="{{ route('admin.shipping.update', $order->id) }}" method="POST">
                                    @csrf
                                    <select name="status" class="form-select form-select-sm mb-2">
                                        <option value="dikemas" {{ $order->status === 'dikemas' ? 'selected' : '' }}>dikemas
                                        </option>
                                        <option value="dikirim" {{ $order->status === 'dikirim' ? 'selected' : '' }}>dikirim
                                        </option>
                                        <option value="diterima" {{ $order->status === 'diterima' ? 'selected' : '' }}>
                                            diterima</option>
                                    </select>
                                    <button class="btn btn-sm btn-success">Update</button>
                                </form>
                            @else
                                <span class="text-success">✔️ Diterima</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
