@extends('layouts.admin')

@section('titile')
    Edit Customer
@endsection

@section('content')
    <div class="container">
        <h2>Edit Customer</h2>
        <form action="{{ route('customer.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username"
                       value="{{ old('username', $user->username) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password (Kosongkan jika tidak ingin mengganti)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <div class="mb-3">
                <label for="dob" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="dob" name="dob"
                       value="{{ old('dob', $user->dob) }}" required>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Jenis Kelamin</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="L" {{ $user->gender === 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ $user->gender === 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="address" name="address"
                       value="{{ old('address', $user->address) }}" required>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">Kota</label>
                <input type="text" class="form-control" id="city" name="city"
                       value="{{ old('city', $user->city) }}" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Nomer HP</label>
                <input type="text" class="form-control" id="phone" name="phone"
                       value="{{ old('phone', $user->phone) }}" required>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('customer.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
