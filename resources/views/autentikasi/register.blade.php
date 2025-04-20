@extends('layouts.app')

@section('title')
    Daftar Akun
@endsection

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Form Registrasi</h2>
        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi Password" required>
            <input type="date" name="dob" class="form-control" required>
            <select name="gender" class="form-select" required>
                <option value="">Pilih Gender</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
            <textarea name="address" class="form-control" placeholder="Alamat" required></textarea>
            <input type="text" name="city" class="form-control" placeholder="Kota" required>
            <input type="text" name="phone" class="form-control" placeholder="No Telepon" required>
            <button type="submit" class="btn btn-primary">Daftar</button>
        </form>

    </div>
@endsection
