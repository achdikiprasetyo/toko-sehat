@extends('layouts.admin')

@section('title')
    Permohonan Buka Toko
@endsection

@section('content')
<div class="container py-4">
    <h3 class="fw-bold mb-4">Permohonan Pembukaan Toko</h3>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status Permohonan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($requests as $request)
                        <tr class="align-middle">
                            <td>{{ $request->user->username }}</td>
                            <td>{{ $request->user->email }}</td>
                            <td class="text-center">
                                @switch($request->status)
                                    @case('approved')
                                        <span class="badge bg-success">Diterima</span>
                                        @break
                                    @case('pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                        @break
                                    @default
                                        <span class="badge bg-danger">Ditolak</span>
                                @endswitch
                            </td>
                            <td class="text-center">
                                @if ($request->user->role == 'customer')
                                    <form action="{{ route('sellerRequests.approve', $request->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Terima</button>
                                    </form>
                                    <form action="{{ route('sellerRequests.reject', $request->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                    </form>
                                @else
                                    <button class="btn btn-sm btn-outline-secondary" disabled>Sudah Diterima</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada permohonan buka toko.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
