@extends('layouts.auth')
@section('title')
Login
@endsection


@section('css')
<link rel="stylesheet" href="{{ asset('stisla/jquery-selectric/selectric.css') }}">
@endsection

@section('content')
<section class="section">
  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

        <div class="login-brand">
          <img src="{{ asset('img/gajahwahana.png') }}" alt="SMK Nusa Dua Logo" width="100"
            class="shadow-light rounded-circle">
        </div>

        <div class="card card-primary">
          <div class="card-header">
            <h4>Sistem Informasi Pembayaran SPP SMK Nusa Dua</h4>
          </div>

          <div class="card-body">
            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
              @csrf
              <div class="form-group">
                <label for="username">Username</label>
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                  value="{{ old('username') }}" name="username" tabindex="1" required autofocus autocomplete="username">
                @error('username')
                <span class="invalid-feedback" role="alert">
                  <strong>Sorry, the username you entered is wrong</strong>
                </span>
                @enderror
              </div>

              <div class="form-group">
                <div class="d-block">
                  <label for="password" class="control-label">Password</label>
                </div>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" tabindex="2" required autocomplete="current-password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>password is wrong</strong>
                </span>
                @enderror
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                  Login
                </button>
              </div>
            </form>

          </div>
        </div>
        <div class="simple-footer">
          Copyright &copy; {{ date('Y') }}
          <div class="bullet"></div> Sistem Informasi Pembayaran SPP - SMK Nusa Dua | By <a
            href="https://akhmadrizki.github.io/" target="_blank">Akhmad
            Rizki</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('js')
<script src="{{ asset('stisla/cleave-js/cleave.min.js')}}"></script>
<script src="{{ asset('stisla/cleave-js/addons/cleave-phone.id.js') }}"></script>
<script src="{{ asset('stisla/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
<script src="{{ asset('stisla/jquery-selectric/jquery.selectric.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
@endsection