@extends('layouts.dashboard')

@section('title', 'List Tagihan')

@section('css')
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet"
  href="{{ asset('stisla/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('main-content')
<div class="section-header">
  <h1>List Tagihan</h1>
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
        <div class="card-header">
          <a href="{{ route('bill.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i>
            Buat Tagihan Baru</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Bulan</th>
                  <th>Tahun</th>
                  <th>Kelas</th>
                  <th>Deskripsi</th>
                  <th>Jumlah</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                @foreach ($bills as $bill)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $bill->month }}</td>
                  <td>{{ $bill->year }}</td>
                  <td>{{ $bill->grade->name }}</td>
                  <td>{{ $bill->description }}</td>
                  <td>Rp.{{ number_format($bill->total, 0, ',', '.') }}</td>
                  <td>
                    <a href="{{ route('bill.edit', $bill->id) }}" class="btn btn-sm btn-icon icon-left btn-primary"><i
                        class="fas fa-edit"></i>
                      Edit</a>

                    <button class="btn btn-sm btn-icon icon-left btn-danger" title="delete" data-toggle="modal"
                      data-target="#modal-{{ $bill->id }}">
                      <i class="fas fa-trash-alt"></i> Hapus
                    </button>
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

@section('modals')
@foreach ($bills as $bill)
<div class="modal fade" id="modal-{{ $bill->id }}" tabindex="-1" aria-labelledby="modal-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-label">Hapus Tagihan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Yakin mau hapus tagihan bulan {{ $bill->month }}?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
        <form action="{{ route('bill.destroy', $bill->id) }}" method="POST">
          @method('DELETE')
          @csrf
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection

@section('js')
<script src="{{ asset('stisla/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('stisla/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('stisla/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('stisla/js/page/modules-datatables.js') }}"></script>
@endsection