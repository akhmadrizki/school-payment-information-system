@extends('layouts.dashboard')

@section('title', 'Tunggakan')

@section('css')
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet"
  href="{{ asset('stisla/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('main-content')
<div class="section-header">
  <h1>List Tunggakan</h1>
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
                  <th>Bulan</th>
                  <th>Kelas</th>
                  <th>Tahun</th>
                  <th>Status</th>
                  <th>Total Tunggakan</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                @foreach ($bills as $bill)
                <tr class="text-capitalize">
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $bill->month }}</td>
                  <td>{{ $bill->grade->name }}</td>
                  <td>{{ $bill->year }}</td>
                  <td><span class="badge badge-warning">{{ $bill->scholarship->name }}</span></td>

                  @php
                  $getTotal = $bill->invoices->sum('total');
                  @endphp
                  <td>Rp{{ number_format($getTotal, 0, ',', '.') }}</td>

                  <td>
                    @php
                    $getStatus = $bill->invoices;
                    $countData = $getStatus->count();
                    @endphp
                    <a href="{{ route('tunggakan.show', $bill->id) }}"
                      class="btn btn-sm btn-icon icon-left btn-primary {{ $countData != 0 ? 'none' :  'disabled'}}"><i
                        class=" fas fa-eye"></i>
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