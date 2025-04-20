@extends('layouts.app')

@section('title')
    Daftar Akun
@endsection

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Form Registrasi</h2>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>

            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi Password"
                    required>
            </div>

            <div class="mb-3">
                <label for="dob" class="form-label">Tanggal Lahir</label>
                <input type="date" name="dob" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Jenis Kelamin</label>
                <select name="gender" class="form-select" required>
                    <option value="">Pilih Gender</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <textarea name="address" class="form-control" placeholder="Alamat" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <input type="text" name="city" class="form-control" placeholder="Kota" required>
            </div>

            <div class="mb-3">
                <input type="text" name="phone" class="form-control" placeholder="No Telepon" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Daftar</button>
            </div>
        </form>
    </div>
@endsection
