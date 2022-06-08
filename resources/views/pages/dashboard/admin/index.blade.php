@extends('layouts.dashboard')

@section('title', 'List Admin')

@section('css')
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet"
  href="{{ asset('stisla/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('main-content')
<div class="section-header">
  <h1>List Admin</h1>
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
          <a href="{{ route('admin.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i>
            Tambah Data Admin</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped" id="table-1">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Alamat</th>
                  <th>Kontak</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                @foreach ($admin as $adm)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $adm->user->name }}</td>
                  <td>{{ $adm->user->email }}</td>
                  <td>{{ $adm->address }}</td>
                  <td><a href="wa.me/{{ $adm->contact }}" target="_blank">{{ $adm->contact }}</a></td>
                  <td>
                    <a href="{{ route('admin.edit', $adm->id) }}" class="btn btn-sm btn-icon icon-left btn-primary"><i
                        class="fas fa-edit"></i>
                      Edit</a>

                    <button class="btn btn-sm btn-icon icon-left btn-danger" title="delete" data-toggle="modal"
                      data-target="#modal-{{ $adm->id }}">
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
@foreach ($admin as $adm)
<div class="modal fade" id="modal-{{ $adm->id }}" tabindex="-1" aria-labelledby="modal-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-label">Hapus Data Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Yakin mau hapus data {{ $adm->user->name }}?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
        <form action="{{ route('admin.destroy', $adm->id) }}" method="POST">
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