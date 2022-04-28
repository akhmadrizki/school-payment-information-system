@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('main-content')
<div class="section-header">
  <h1>Welcome Back, <span class="text-capitalize">{{ Auth::user()->name }} ✋</span></h1>
</div>

<div class="section-body">
  <div class="row">
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
  </div>
</div>
@endsection