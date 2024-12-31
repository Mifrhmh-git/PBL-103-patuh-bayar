<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panduan Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        .navbar {
            background-color: #28a745; /* Green Navbar */
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .navbar-nav .nav-link:hover {
            color: #f8f9fa !important;
        }
        .card-header {
            background-color: #28a745; /* Green Header for Cards */
            color: white;
        }
        .footer {
            background-color: #28a745;
            color: white;
        }
        .list-group-item {
            border-left: 5px solid transparent;
        }
        .list-group-item:hover {
            border-left: 5px solid #28a745; /* Green hover effect */
        }
        .btn-green {
            background-color: #28a745;
            color: white;
            border: none;
        }
        .btn-green:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('panduanpengguna') }}">Patuh-Bayar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('panduanpengguna') }}">Panduan Pengguna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <h1 class="text-center mb-4">Panduan Pengguna Aplikasi Patuh-Bayar</h1>

        <!-- Pendahuluan -->
        <div class="card mb-4">
            <div class="card-header">
                Pendahuluan
            </div>
            <div class="card-body">
                <p>Aplikasi <strong>Patuh-Bayar</strong> mempermudah pengelolaan data warga dan pembayaran secara online. Akses pengguna terbagi menjadi dua yaitu <strong>bendahara</strong> dan <strong>ketua RW</strong>. Berikut panduan penggunaannya.</p>
            </div>
        </div>

        <!-- Fitur Utama -->
        <div class="card mb-4">
            <div class="card-header">
                Fitur Utama
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Pengelolaan data warga</li>
                    <li class="list-group-item">Pengelolaan data pembayaran</li>
                    <li class="list-group-item">Laporan keuangan</li>
                    <li class="list-group-item">Pengingat pembayaran jatuh tempo via email</li>
                </ul>
            </div>
        </div>

        <!-- Hak Akses Pengguna -->
        <div class="card mb-4">
            <div class="card-header">
                Hak Akses Pengguna
            </div>
            <div class="card-body">
                <h5>Bendahara</h5>
                <ul>
                    <li>Menambah, mengedit, dan menghapus data warga</li>
                    <li>Menambah dan memperbarui data pembayaran</li>
                    <li>Membuat laporan keuangan</li>
                </ul>
                <h5>Ketua RW</h5>
                <ul>
                    <li>Melihat data warga</li>
                    <li>Memantau status pembayaran</li>
                    <li>Melihat laporan keuangan</li>
                </ul>
            </div>
        </div>

        <!-- Panduan untuk Bendahara -->
        <div class="card mb-4">
            <div class="card-header">
                Panduan untuk Bendahara
            </div>
            <div class="card-body">
                <ol>
                    <li><strong>Login :</strong> Masukkan email dan kata sandi Anda.</li>
                    <li><strong>Pengelolaan Data Warga :</strong> Tambah, edit, atau hapus data warga di menu "Data Warga".</li>
                    <li><strong>Pengelolaan Data Pembayaran :</strong> Catat pembayaran baru atau perbarui status pembayaran di menu "Data Pembayaran".</li>
                    <li><strong>Laporan Keuangan :</strong> Unduh laporan dari menu "Laporan Keuangan".</li>
                </ol>
            </div>
        </div>

        <!-- Panduan untuk Ketua RW -->
        <div class="card mb-4">
            <div class="card-header">
                Panduan untuk Ketua RW
            </div>
            <div class="card-body">
                <ol>
                    <li><strong>Login :</strong> Masukkan email dan kata sandi Anda.</li>
                    <li><strong>Melihat Data Warga :</strong> Akses menu "Data Warga" untuk memantau data warga.</li>
                    <li><strong>Melihat Pembayaran :</strong> Pantau status pembayaran melalui menu "Data Pembayaran".</li>
                    <li><strong>Laporan Keuangan :</strong> Unduh laporan dari menu "Laporan Keuangan".</li>
                </ol>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer text-center py-3">
        &copy; 2024 Website Patuh-Bayar. Tim PBL 103.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
