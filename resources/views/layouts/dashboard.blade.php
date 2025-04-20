<div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-12 bg-dark text-white p-3" style="min-height: 100vh;">
                <h4 class="text-center mb-4">Admin Dashboard</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Manajemen Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('kategori.index') }}">Manajemen Kategori</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Manajemen Customer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">Laporan</a>
                    </li>
                </ul>
            </div>
    
            <!-- Main Content Area -->
            <div class="col-md-9 col-12">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center p-3">
                    <h3>Dashboard Admin</h3>
                    <div class="dropdown">
                        <a class="btn btn-light dropdown-toggle" href="#" role="button" id="userDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            👤 {{ Auth::user()->username }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile') }}">Detail Profil</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="GET" class="d-inline">
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
    
                <!-- Main Dashboard Content -->
                
            </div>
        </div>
    </div>