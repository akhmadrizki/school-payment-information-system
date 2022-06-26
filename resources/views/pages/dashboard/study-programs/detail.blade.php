@extends('layouts.dashboard')

@section('title', $student->user->name. '-' .$student->grade->name)

@section('css')
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet"
  href="{{ asset('stisla/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('main-content')
<div class="section-header">
  <h1>{{ $student->user->name }} - {{ $student->grade->name }}</h1>

  <div class="section-header-breadcrumb">
    <a href="{{ url()->previous() }}" class="btn btn-sm btn-icon icon-left btn-primary">
      <i class="fas fa-arrow-left"></i> Kembali
    </a>
  </div>
</div>

<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Bulan</th>
                  <th>Jumlah</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                @foreach ($invoice as $student)
                <tr class="text-capitalize">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $student->bill->month }}</td>
                  <td>Rp{{ number_format($student->total, 0, ',', '.') }}</td>
                  <td>
                    @php
                    $status = $student->status == 'PENDING' ? 'BELUM LUNAS' : 'LUNAS';
                    @endphp
                    <span class="badge badge-{{ $student->status == 'PENDING' ? 'warning' : 'success' }}">{{
                      $status }}</span>
                  </td>
                  <td>
                    <a href="{{ route('admin.study-program.detail-payment', $student->id) }}"
                      class="btn btn-sm btn-icon icon-left btn-primary"><i class="far fa-eye"></i> Lihat
                      Detail</a>
                  </td>
                </tr>
                @endforeach
              </tbody>

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="{{ asset('stisla/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('stisla/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('stisla/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('stisla/js/page/modules-datatables.js') }}"></script>
@endsection