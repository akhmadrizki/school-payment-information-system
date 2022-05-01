@extends('layouts.dashboard')

@section('title', ' ' . $getUser->name)

@section('css')
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet"
  href="{{ asset('stisla/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('main-content')
<div class="section-header">
  <h1>Detail Pembayaran SPP - <span class="text-capitalize">{{ $invoice->bill->month }}</span> {{
    $invoice->bill->year
    }} | <span class="text-capitalize">{{ $getUser->name }}</span></h1>

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
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped table-md">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Keterangan</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>{{ $invoice->bill->description }}</td>
                  <td>Rp.{{ number_format($invoice->total, 0, ',', '.') }}</td>
                </tr>

                <tr>
                  <th colspan="2">Grand Total</th>
                  <th>Rp.{{ number_format($invoice->total, 0, ',', '.') }}</th>
                </tr>

                @if ($invoice->status != 'PENDING')
                <tr>
                  <th colspan="2">Metode Pembayaran</th>
                  <th style="list-style-type: none">
                    <li>{{ $getInvoice['payment_method'] }}</li>
                    <li>{{ $getInvoice['payment_channel'] }}</li>
                  </th>
                </tr>
                @endif

                <tr>
                  <th colspan="2"></th>
                  <th>
                    @php
                    $status = $invoice->status == 'PENDING' ? 'BELUM LUNAS' : 'LUNAS';
                    @endphp
                    <span class="badge badge-{{ $invoice->status == 'PENDING' ? 'warning' : 'success' }}">{{
                      $status }}</span>
                  </th>
                </tr>
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