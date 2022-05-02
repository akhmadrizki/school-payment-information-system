@extends('layouts.dashboard')

@section('title', 'Tunggakan'. ' ' .$bills->month)

@section('css')
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet"
  href="{{ asset('stisla/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('main-content')
<div class="section-header">
  <h1>List Tunggakan Bulan <span class="text-capitalize">{{ $bills->month }}</span> - {{ $bills->year }}</h1>
</div>

<div class="section-body">
  <div class="row">
    <div class="col-12">
      @if (session('message'))
      <div class="alert alert-{{ session('status') }} alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="alert">
            <span>×</span>
          </button>
          {{ session('message') }}
        </div>
      </div>
      @endif

      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Jurusan</th>
                  <th>Tunggakan</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                @foreach ($bills->invoices as $invoice)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $invoice->user->students->nis }}</td>
                  <td>{{ $invoice->user->name }}</td>
                  <td>
                    {{ $invoice->user->students->grade->name }} - {{ $invoice->user->students->studyProgram->name }}
                  </td>
                  <td>Rp.{{ number_format($invoice->total, 0, ',', '.') }}</td>
                  <td><span class="badge badge-warning">{{ $invoice->user->students->scholarship->name }}</span></td>
                  <td>
                    <a href="#" class="btn btn-sm btn-icon icon-left btn-warning">
                      <i class="fas fa-paper-plane"></i> Kirim pengingat
                    </a>
                  </td>
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