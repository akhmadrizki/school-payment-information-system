@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('main-content')
<div class="section-header">
  <h1>Welcome Back, <span class="text-capitalize">{{ Auth::user()->name }} ✋</span></h1>
</div>

<div class="section-body">
  <div class="row">

    <div class="col-12">
      @if (session('message'))
      <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="alert">
            <span>×</span>
          </button>
          {{ session('message') }}
        </div>
      </div>
      @endif
    </div>

    @if (auth()->user()->role_id != 3)
    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">

        <div class="card-icon shadow-primary bg-primary">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Pemasukkan {{ date('F') }} {{ date('Y') }}</h4>
          </div>
          <div class="card-body">
            @php
            $income = $getInvoice->sum('total');
            @endphp
            Rp.{{ number_format($income, 0, ',', '.') }}
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">

        <div class="card-icon shadow-primary bg-warning">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Siswa</h4>
          </div>
          <div class="card-body">
            {{ $getStudents->count() }}
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">

        <div class="card-icon shadow-primary bg-info">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Jurusan</h4>
          </div>
          <div class="card-body">
            {{ $studyPrograms->count() }}
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">

        <div class="card-icon shadow-primary bg-danger">
          <i class="fas fa-user-graduate"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Siswa Reguler</h4>
          </div>
          <div class="card-body">
            {{ $regular->count() }}
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">

        <div class="card-icon shadow-primary bg-danger">
          <i class="fas fa-user-graduate"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Beasiswa Bidikmisi</h4>
          </div>
          <div class="card-body">
            {{ $bidikmisi->count() }}
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">

        <div class="card-icon shadow-primary bg-danger">
          <i class="fas fa-user-graduate"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Beasiswa Berprestasi</h4>
          </div>
          <div class="card-body">
            {{ $prestasi->count() }}
          </div>
        </div>
      </div>
    </div>

    @endif

    @if (auth()->user()->role_id == 1)
    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">

        <div class="card-icon shadow-primary bg-success">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Admin</h4>
          </div>
          <div class="card-body">
            {{ $getAdmin->count() }}
          </div>
        </div>
      </div>
    </div>
    @endif

    @if (auth()->user()->role_id == 3)
    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">

        <div class="card-icon shadow-primary bg-primary">
          <i class="fas fa-hand-holding-usd"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Tunggakan Pembayaran</h4>
          </div>
          <div class="card-body">
            @php
            $total = $arrears->sum('total');
            @endphp
            Rp.{{ number_format($total, 0, ',', '.') }}
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">

        <div class="card-icon shadow-primary bg-success">
          <i class="fas fa-receipt"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Informasi Pembayaran</h4>
          </div>
          <div class="card-body">
            <a href="#" class="btn btn-outline-success btn-sm btn-icon icon-right">Lihat Informasi Pembayaran SPP <i
                class="fas fa-long-arrow-alt-right"></i></a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">

        <div class="card-icon shadow-primary bg-warning">
          <i class="fas fa-id-badge"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Data Pribadi</h4>
          </div>
          <div class="card-body">
            <a href="#" class="btn btn-outline-warning btn-sm btn-icon icon-right">Lihat Profile Saya <i
                class="fas fa-long-arrow-alt-right"></i></a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card card-statistic-2">

        <div class="card-icon shadow-primary bg-info">
          <i class="fas fa-comment-dots"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Contact Admin</h4>
          </div>
          <div class="card-body">
            <a href="#" class="btn btn-outline-info btn-sm btn-icon icon-right">Hubungi Admin <i
                class="fas fa-long-arrow-alt-right"></i></a>
          </div>
        </div>
      </div>
    </div>
    @endif

  </div>
</div>
@endsection