@extends('layouts.app')

@section('title')
    Informasi Pengguna
@endsection

@section('content')
    <div class="container mt-4">
        <h2>Profil Pengguna</h2>
        <div class="card mt-3">
            <div class="card-body">
                <p><strong>Username:</strong> {{ $user->username }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($user->dob)->format('d-m-Y') }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $user->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                <p><strong>Alamat:</strong> {{ $user->address }}</p>
                <p><strong>Kota:</strong> {{ $user->city }}</p>
                <p><strong>Nomor HP:</strong> {{ $user->phone }}</p>
                <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                <p>s</p>
            </div>
        </div>
    </div>
@endsection
    