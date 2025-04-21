<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Toko Sehat Online')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row min-vh-100">
            {{-- Sidebar --}}
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark text-white p-3">
                <h4 class="text-center mb-4">Admin Panel</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('produk.index') ? 'fw-bold' : '' }}"
                            href="{{ route('produk.index') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('kategori.index') ? 'fw-bold' : '' }}"
                            href="{{ route('kategori.index') }}">Kategori Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('customer.index') ? 'fw-bold' : '' }}"
                            href="{{ route('customer.index') }}">Manajemen Customer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('admin.shipping') ? 'fw-bold' : '' }}"
                            href="{{ route('admin.shipping') }}">Pengiriman Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('sellerRequests.index') ? 'fw-bold' : '' }}"
                            href="{{ route('sellerRequests.index') }}">Pembukaan Toko</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white {{ request()->routeIs('ulasan.index') ? 'fw-bold' : '' }}"
                            href="{{ route('ulasan.index') }}">Ulasan Customer</a>
                    </li>
                </ul>
            </nav>

            {{-- Content --}}
            <main class="col-md-9 col-lg-10 ms-sm-auto px-4">
                {{-- Header --}}
                <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                    <h4 class="mb-0">@yield('title', 'Dashboard Admin')</h4>
                    <div class="dropdown">
                        <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            👤 {{ Auth::user()->username }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form action="{{ route('logout') }}" method="GET">
                                    @csrf
                                    <button class="dropdown-item text-danger" type="submit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- Content Section --}}
                <div class="mt-4">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
