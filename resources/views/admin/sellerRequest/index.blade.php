@extends('layouts.admin')

@section('title')
    Permohonan Buka Toko
@endsection

@section('content')
    <div class="container mt-4">
        <h3>Permohonan Pembukaan Toko</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Status Permohonan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $request)
                    <tr>
                        <td>{{ $request->user->username }}</td>
                        <td>{{ $request->user->email }}</td>
                        <td>
                            @if ($request->status == 'approved')
                                <span class="badge bg-success">Diterima</span>
                            @elseif ($request->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>
                            @if ($request->user->role == 'customer')
                                <form action="{{ route('sellerRequests.approve', $request->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Terima</button>
                                </form>
                                <form action="{{ route('sellerRequests.reject', $request->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                                </form>
                            @else
                                <button class="btn btn-sm btn-success" disabled>Sudah Diterima</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
