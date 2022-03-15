@extends('layouts.dashboard')

@section('title', 'XII Tata Niaga')

@section('css')
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet"
  href="{{ asset('stisla/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('main-content')
<div class="section-header">
  <h1>Kelas XII Tata Niaga</h1>

  <div class="section-header-breadcrumb">
    <a href="{{ url()->previous() }}" class="btn btn-sm btn-icon icon-left btn-primary">
      <i class="fas fa-arrow-left"></i> Kembali
    </a>
  </div>
</div>

<div class="section-body">
  <div class="row">
    <div class="col-12">
      {{-- @if (session('message'))
      <div class="alert alert-{{ session('status') }} alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="alert">
            <span>×</span>
          </button>
          {{ session('message') }}
        </div>
      </div>
      @endif --}}

      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th>NIS</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach ($students as $student)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $student->nis }}</td>
                  <td>{{ $student->user->name }}</td>
                  <td>
                    @foreach ($student->user->invoice as $status)

                    <span class="badge badge-{{ $status->status == 'belum lunas' ? 'danger' : 'success' }}">{{
                      $status->status }}</span>

                    @endforeach
                  </td>
                  <td>
                    @foreach ($student->user->invoice as $nominal)
                    Rp.{{ number_format($nominal->total, 0, ',', '.') }}
                    @endforeach
                  </td>
                  <td>
                    @foreach ($student->user->invoice as $status)
                    <a href="#"
                      class="btn btn-sm btn-icon icon-left btn-warning {{ $status->status == 'belum lunas' ? 'none' :  'disabled'}}">
                      <i class="fas fa-paper-plane"></i> Kirim pengingat
                    </a>
                    @endforeach
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