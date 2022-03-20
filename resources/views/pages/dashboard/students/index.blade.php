@extends('layouts.dashboard')

@section('title', 'List Siswa')

@section('css')
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet"
  href="{{ asset('stisla/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('main-content')
<div class="section-header">
  <h1>List Siswa</h1>
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
                  <th>NIS</th>
                  <th>Name</th>
                  <th>Jurusan</th>
                  <th>Kelas</th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                @foreach ($students as $student)
                <tr>
                  <td>{{ $student->nis }}</td>
                  <td>{{ $student->user->name }}</td>
                  <td>{{ $student->studyProgram->name }}</td>
                  <td>{{ $student->grade->name }}</td>
                  <td>
                    <a href="{{ route('siswa.edit', $student->id) }}"
                      class="btn btn-sm btn-icon icon-left btn-primary"><i class="fas fa-edit"></i>
                      Edit</a>
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