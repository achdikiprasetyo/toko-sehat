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
                    <h6 class="text-end">Ongkir: Rp {{ number_format($order->ongkir, 0, ',', '.') }}</h6>
                    <h5 class="text-end">Total: Rp {{ number_format($order->total, 0, ',', '.') }}</h5>

                    @if ($order->status === 'dikemas')
                        <form action="{{ route('history.cancel', $order->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                            @csrf
                            <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                        </form>
                    @endif

                    @if ($order->status === 'diterima')
                        @if (in_array($order->id, $reviewedCheckoutIds))
                            <span class="badge bg-success">Sudah diulas</span>
                        @else
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#reviewModal{{ $order->id }}">
                                Berikan Ulasan
                            </button>
                        @endif
                    @endif

                    <!-- Modal Ulasan -->
                    <div class="modal fade" id="reviewModal{{ $order->id }}" tabindex="-1"
                        aria-labelledby="reviewModalLabel{{ $order->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('review.submit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="checkout_id" value="{{ $order->id }}">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reviewModalLabel{{ $order->id }}">Berikan Ulasan
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Tutup"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="review" class="form-label">Ulasan</label>
                                            <textarea name="review" class="form-control" rows="4" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="rating" class="form-label">Rating</label>
                                            <select name="rating" class="form-select" required>
                                                <option value="">Pilih Rating</option>
                                                @for ($i = 5; $i >= 1; $i--)
                                                    <option value="{{ $i }}">{{ $i }} Bintang
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Kirim</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        @empty
            <div class="alert alert-info">Belum ada riwayat pembelian.</div>
        @endforelse
    </div>
@endsection
