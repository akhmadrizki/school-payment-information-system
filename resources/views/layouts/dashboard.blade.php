<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title') | SMK Nusa Dua</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

  <!-- CSS Libraries -->
  @yield('css')

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('stisla/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/css/components.css') }}">

  <!-- Page Specific CSS -->
  @yield('custom-css')

</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <ul class="navbar-nav mr-auto">
          <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
          </li>
        </ul>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="avatar" src="{{ asset('stisla/img/avatar-1.png')}}" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="#" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Edit Profile
              </a>
              <a href="{{ route('logout') }}" id="logout" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
              <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display:none;">
                {{ csrf_field() }}
              </form>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="#">SMK Nusa Dua</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">SKND</a>
          </div>
          <ul class="sidebar-menu">
            <li class="{{ Request::route()->getName() == 'admin.dashboard' ? 'active' : null }}">
              <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
              </a>
            </li>

            <!-- For Roles Admin and Master -->
            @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
            <li class="{{ Request::route()->getName() == 'bill.index' ? 'active' : null }}">
              <a class="nav-link" href="{{ route('bill.index') }}">
                <i class="fas fa-bullhorn"></i> <span>Buat Tagihan</span>
              </a>
            </li>

            <li class="{{ Request::route()->getName() == 'tunggakan.index' ? 'active' : null }}">
              <a class="nav-link" href="{{ route('tunggakan.index') }}">
                <i class="fas fa-inbox"></i> <span>Tunggakan</span>
              </a>
            </li>

            <li class="{{ Request::route()->getName() == 'admin.income.index' ? 'active' : null }}">
              <a class="nav-link" href="{{ route('admin.income.index') }}">
                <i class="fas fa-cash-register"></i> <span>Pemasukkan</span>
              </a>
            </li>

            <li class="menu-header">Siswa</li>
            <li class="{{ Request::route()->getName() == 'admin.perhotelan' ? 'active' : null }}">
              <a class="nav-link" href="{{ route('admin.perhotelan') }}">
                <i class="fas fa-hotel"></i> <span>Akomodasi Perhotelan</span>
              </a>
            </li>
            <li class="{{ Request::route()->getName() == 'admin.multimedia' ? 'active' : null }}">
              <a class="nav-link" href="{{ route('admin.multimedia') }}">
                <i class="fas fa-desktop"></i> <span>Multimedia</span>
              </a>
            </li>
            <li class="{{ Request::route()->getName() == 'admin.tata-boga' ? 'active' : null }}">
              <a class="nav-link" href="{{ route('admin.tata-boga') }}">
                <i class="fas fa-utensils"></i> <span>Tata Boga</span>
              </a>
            </li>
            <li class="{{ Request::route()->getName() == 'admin.tata-niaga' ? 'active' : null }}">
              <a class="nav-link" href="{{ route('admin.tata-niaga') }}">
                <i class="fas fa-wallet"></i> <span>Tata Niaga</span>
              </a>
            </li>

            <li class="menu-header">Data</li>
            <li class="{{ Request::route()->getName() == 'admin.index' ? 'active' : null }}"
              style="display :{{ auth()->user()->role_id == 2 ? 'none' : ' '}}">
              <a class="nav-link" href="{{ route('admin.index') }}">
                <i class="fas fa-user"></i> <span>Data Admin</span>
              </a>
            </li>
            <li class="{{ Request::route()->getName() == 'siswa.index' ? 'active' : null }}">
              <a class="nav-link" href="{{ route('siswa.index') }}">
                <i class="fas fa-user"></i> <span>Data Siswa</span>
              </a>
            </li>

            <!-- For Role Student -->
            @elseif(auth()->user()->role_id == 3)
            <li class="menu-header">Data</li>
            <li class="{{ Request::route()->getName() == 'student.payment-info' ? 'active' : null }}">
              <a class="nav-link" href="{{ route('student.payment-info') }}">
                <i class="fas fa-receipt"></i> <span>Informasi Pembayaran</span>
              </a>
            </li>

            <li>
              <a class="nav-link" href="#">
                <i class="fas fa-id-card"></i> <span>Profil Saya</span>
              </a>
            </li>

            @endif
            <!-- End Conditional -->

          </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          @yield('main-content')
        </section>
      </div>

      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; {{ date('Y') }}
          Sistem Informasi Pembayaran SPP - SMK Nusa Dua | By <a href="https://akhmadrizki.github.io/"
            target="_blank">Akhmad Rizki</a>
        </div>
        <div class="footer-right">
          0.1.0
        </div>
      </footer>
    </div>
  </div>

  @yield('modals')

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="{{ asset('stisla/js/stisla.js') }}"></script>

  <!-- JS Libraies -->
  @yield('js')

  <!-- Template JS File -->
  <script src="{{ asset('stisla/js/scripts.js') }}"></script>
  <script src="{{ asset('stisla/js/custom.js') }}"></script>

  <!-- Page Specific JS -->
  @yield('custom-js')
</body>

</html>