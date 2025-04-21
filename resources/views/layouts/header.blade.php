<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary ">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo"
                    style="width: 50px; height: 50px; margin-right: 10px;">
                <strong>Toko Sehat Online</strong>
            </a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('welcome') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('produk.list') }}">Produk</a>
                </li>
            </ul>

            <div class="d-flex gap-2">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-light">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Daftar</a>
                @endguest

                @auth
                    <a class="nav-link mt-1" href="{{ route('keranjang.index') }}">
                        🛒 Keranjang
                        @php
                            $jumlahKeranjang = \App\Models\Cart::where('user_id', auth()->id())->count();
                        @endphp
                        @if ($jumlahKeranjang > 0)
                            <span class="badge bg-danger">{{ $jumlahKeranjang }}</span>
                        @endif
                    </a>
                    <div class="dropdown">
                        <a class="btn btn-light dropdown-toggle" href="#" role="button" id="userDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            👤 {{ Auth::user()->username }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile') }}">Detail Profil</a></li>
                            <li><a class="dropdown-item" href="{{ route('seller.customer') }}">Toko Saya</a></li>
                            <li><a class="dropdown-item" href="{{ route('history.index') }}">History Pembelian</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="GET" class="d-inline">
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>

        </div>
        </div>
    </nav>
</body>

</html>
