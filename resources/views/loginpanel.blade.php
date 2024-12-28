<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/logo.jpg">
  <link rel="icon" type="image/png" href="../assets/img/logo.jpg">
  <title>{{ $title }}</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-design-system.css?v=1.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="sign-in-illustration">
  <!-- Navbar -->

  <section>
    <div class="page-header min-vh-100">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
            <div class="card card-plain">
              <div class="card-header pb-0 text-left">
                <h4 class="font-weight-bolder">Masuk</h4>
                <p class="mb-0">Masukkan email dan kata sandi anda untuk masuk</p>
              </div>
              <div class="card-body">

                <form class="pt-3" method="POST" action="{{ route('login.cek') }}">
                  @csrf
                  <div class="mb-3">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                  </div>
                  <div class="mb-3">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Kata Sandi">
                  </div>
                  <div class="text-center">
                    <button name="submit" type="submit" class="btn btn-lg bg-gradient-success btn-lg w-100 mt-4 mb-0">Masuk</button>
                  </div>
                </form>

              </div>

            </div>
          </div>
          <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
            <div class="position-relative bg-gradient-success h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center">
              <img src="../assets/img/shapes/pattern-lines.svg" alt="pattern-lines" class="position-absolute opacity-50 start-0">
              <div class="position-relative">
                <a href="{{ url('/') }}"><img class="max-width-300 w-100 position-relative z-index-2" src="../assets/img/logo-bg.png"></a>
              </div>
              <a href="{{ url('/') }}"><h3 class="mt-5 text-white font-weight-bolder">Aplikasi Patuh Bayar</h3></a>
              <p class="text-white">Aplikasi patuhbayar menyediakan fitur-fitur terkait sistem pembayaran  iuran warga, seperti iuran keamanan, iuran listrik dan juga iuran kas, yang bisa mempermudah pengelolaan iuran perumahan.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
  <script src="../assets/js/plugins/parallax.min.js"></script>
  <!-- Control Center for Soft UI Kit: parallax effects, scripts for the example pages etc -->
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
  <script src="../assets/js/soft-design-system.min.js?v=1.1.0" type="text/javascript"></script>
</body>

</html>
