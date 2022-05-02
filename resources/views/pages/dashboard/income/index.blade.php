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
  <h1>Pemasukkan SPP</h1>
</div>

<div class="section-body">
  <div class="row">
    <div class="col-12">

      <div class="card">
        <form action="{{ route('admin.income.index') }}" method="GET">
          @csrf
          <div class="card-body">

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="month">Bulan</label>
                <select name="month" id="month" class="form-control">
                  <option value="none" selected disabled>- Pilih Bulan -</option>
                  <option value="january">Januari</option>
                  <option value="february">Februari</option>
                  <option value="march">Maret</option>
                  <option value="april">April</option>
                  <option value="may">Mei</option>
                  <option value="june">Juni</option>
                  <option value="july">Juli</option>
                  <option value="august">Agustus</option>
                  <option value="september">September</option>
                  <option value="october">Oktober</option>
                  <option value="november">November</option>
                  <option value="december">Desember</option>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label>Tahun</label>
                <select name="year" id="year" class="form-control">
                  @php
                  $year = date('Y');
                  @endphp

                  @for ($i = $year; $i <= $year + 8; $i++) <option value="{{ $i }}">{{ $i }}</option>
                    @endfor

                </select>
              </div>
            </div>

            <div class="mt-3 d-flex justify-content-center">
              <button type="submit" class="btn btn-lg btn-primary">Tampilkan</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>


@if (isset($month))
<div class="section-body text-capitalize">
  <div class="row">
    <div class="col-12">

      <div class="card">
        <div class="card-header">
          <h4 class="text-capitalize">{{ $month }} - {{ $year }}</h4>
          <div class="card-header-form">
            <a href="#" class="btn btn-icon icon-left btn-primary"><i class="fas fa-download"></i> Download Data</a>
          </div>
        </div>

        <div class="card-body p-2">
          <div class="table-responsive">
            <table class="table table-striped table-md">
              <thead>
                <tr>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Kelas</th>
                  <th>Jurusan</th>
                  <th>Total</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($invoices as $bill)
                <tr>
                  <td>{{ $bill->user->students->nis }}</td>
                  <td>{{ $bill->user->name }}</td>
                  <td>{{ $bill->bill->grade->name }}</td>
                  <td>{{ $bill->user->students->studyProgram->name }}</td>
                  <td>Rp.{{ number_format($bill->total, 0, ',', '.') }}</td>
                  <td><span class="badge badge-warning">{{ $bill->user->students->scholarship->name }}</span></td>
                </tr>
                @endforeach
                <tr>
                  <th colspan="5">Grand Total</th>
                  @php
                  $total = $invoices->sum('total');
                  @endphp
                  <th>Rp.{{ number_format($total, 0, ',', '.') }}</th>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
@endif

@endsection

@section('js')
<script src="{{ asset('stisla/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('stisla/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('stisla/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('stisla/js/page/modules-datatables.js') }}"></script>
@endsection