<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $title }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css">
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.min.css">
  <!-- SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.0/dist/sweetalert2.min.js"></script>
  <!-- CSS Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light navbar-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

        <!-- Tombol Logout -->
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="button" class="btn btn-success" onclick="confirmLogout()">
                <i class="fas fa-sign-out-alt"></i> keluar
            </button>
        </form>

        <script>
            function confirmLogout() {
                Swal.fire({
                    title: 'Apakah Anda yakin ingin keluar?',
                    text: "Anda akan keluar dari akun ini.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, keluar!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika user mengkonfirmasi, submit form keluar
                        document.getElementById('logout-form').submit();
                    }
                });
            }
        </script>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-maroon">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-bold">Website Patuh Bayar</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/default-profile.png') }}"
                     class="img-circle elevation-2 img-fluid"
                     alt="User Image"
                     style="max-width: 200px; height: auto;">
            </div>
            <div class="info">
                <a href="{{ url('profil') }}" class="d-block">{{ auth()->user()->name }}</a>
                <a href="{{ url('profil') }}" class="d-block" style="font-size: 12px;">{{ auth()->user()->email }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layout.menu')
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<style>
    .main-sidebar {
        background-color: #4b654e ;
        /* background-color: #28a745 ; */
    }
    .brand-link {
        text-align: center; /* Memusatkan teks logo */
    }
    .brand-text {
        font-size: 1.5rem; /* Ukuran font yang lebih besar */
        color: #fff; /* Warna teks putih untuk kontras */
    }
    .user-panel .info a {
        color: #fff; /* Warna teks putih */
    }
    .user-panel .info a:hover {
        color: #f8f9fa; /* Warna teks saat hover */
        text-decoration: underline; /* Garis bawah saat hover */
    }
    .nav-sidebar .nav-link {
        color: #f8f9fa; /* Warna teks menu */
    }
    .nav-sidebar .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1); /* Efek hover pada menu */
        color: #ffffff; /* Warna teks saat hover */
    }
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Page header -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
                @yield('judul')
            </h1>
          </div>

        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">

      @yield('isi')

    </section>
  </div>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
\</div>

<!-- Tambahkan ini sebelum penutup </body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

<!-- jQuery -->
<script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/') }}dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/') }}dist/js/demo.js"></script>
<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- JS Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

</body>
</html>
