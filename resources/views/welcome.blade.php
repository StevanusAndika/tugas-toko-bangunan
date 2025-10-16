<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Perusahaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Atau gunakan CDN resmi -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .welcome-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 2rem;
            margin-top: 2rem;
        }
        .card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        .card-header {
            font-weight: 600;
            text-align: center;
            padding: 1rem;
        }
        .btn-group-vertical .btn {
            margin-bottom: 0.5rem;
            text-align: left;
            border-radius: 5px;
        }
        .btn-group-vertical .btn:last-child {
            margin-bottom: 0;
        }
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #667eea;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="welcome-container">
                    <div class="text-center mb-5">
                        <h1 class="display-4 fw-bold text-primary">Sistem Manajemen Perusahaan</h1>
                        <p class="lead text-muted">Kelola data karyawan, produk, dan penjualan dengan mudah</p>
                    </div>

                    <div class="row">
                        <!-- Karyawan Section -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header bg-primary text-white">
                                    <i class="fas fa-users feature-icon"></i>
                                    <h4 class="mb-0">Manajemen Karyawan</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Kelola data karyawan perusahaan, tambah, lihat, dan hapus data karyawan.</p>
                                    <div class="btn-group-vertical w-100">
                                        <a href="{{ route('karyawan.index') }}" class="btn btn-outline-primary">
                                            <i class="fas fa-list me-2"></i>Lihat Daftar Karyawan
                                        </a>
                                        <a href="{{ route('karyawan.create') }}" class="btn btn-outline-success">
                                            <i class="fas fa-plus me-2"></i>Tambah Karyawan Baru
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Produk Section -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header bg-success text-white">
                                    <i class="fas fa-boxes feature-icon"></i>
                                    <h4 class="mb-0">Manajemen Produk</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Kelola katalog produk perusahaan, tambah, lihat, dan hapus data produk.</p>
                                    <div class="btn-group-vertical w-100">
                                        <a href="{{ route('produk.index') }}" class="btn btn-outline-success">
                                            <i class="fas fa-list me-2"></i>Lihat Daftar Produk
                                        </a>
                                        <a href="{{ route('produk.create') }}" class="btn btn-outline-success">
                                            <i class="fas fa-plus me-2"></i>Tambah Produk Baru
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Penjualan Section -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header bg-warning text-dark">
                                    <i class="fas fa-shopping-cart feature-icon"></i>
                                    <h4 class="mb-0">Manajemen Penjualan</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Kelola data penjualan perusahaan, buat transaksi baru, dan lihat riwayat penjualan.</p>
                                    <div class="btn-group-vertical w-100">
                                        <a href="{{ route('penjualan.index') }}" class="btn btn-outline-warning">
                                            <i class="fas fa-list me-2"></i>Lihat Daftar Penjualan
                                        </a>
                                        <a href="{{ route('penjualan.create') }}" class="btn btn-outline-warning">
                                            <i class="fas fa-plus me-2"></i>Buat Penjualan Baru
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Detail Penjualan Section -->
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header bg-info text-white">
                                    <i class="fas fa-file-invoice-dollar feature-icon"></i>
                                    <h4 class="mb-0">Detail Penjualan</h4>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Kelola detail transaksi penjualan, tambah item, dan lihat rincian penjualan.</p>
                                    <div class="alert alert-info">
                                        <small><i class="fas fa-info-circle me-1"></i>Untuk mengakses detail penjualan, pilih penjualan terlebih dahulu dari menu Manajemen Penjualan.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-secondary text-white">
                                    <h5 class="mb-0">Ringkasan Sistem</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-md-3 mb-3">
                                            <div class="p-3 bg-light rounded">
                                                <h3 class="text-primary">4</h3>
                                                <p class="mb-0">Modul Utama</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="p-3 bg-light rounded">
                                                <h3 class="text-success">12</h3>
                                                <p class="mb-0">Fungsi CRUD</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="p-3 bg-light rounded">
                                                <h3 class="text-warning">3</h3>
                                                <p class="mb-0">Entitas Data</p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="p-3 bg-light rounded">
                                                <h3 class="text-info">1</h3>
                                                <p class="mb-0">Sistem Terintegrasi</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome for Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
