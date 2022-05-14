@extends('layouts.dashboard')

@section('title', ' ' . $getUser->user->name)

@section('css')
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet"
  href="{{ asset('stisla/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('main-content')
<div class="section-header">
  <h1>Edit Profil</h1>

  <div class="section-header-breadcrumb">
    <a href="{{ route('student.profile') }}" class="btn btn-sm btn-icon icon-left btn-primary">
      <i class="fas fa-arrow-left"></i> Kembali
    </a>
  </div>
</div>

<div class="section-body">
  <div class="row">
    <div class="col-12">

      @if (session('message'))
      <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="alert">
            <span>×</span>
          </button>
          {{ session('message') }}
        </div>
      </div>
      @endif

      <div class="card profile-widget">
        <div class="profile-widget-header">
          <img alt="image" src="{{ asset('stisla/img/avatar-1.png')}}" class="rounded-circle profile-widget-picture">
          <div class="profile-widget-items">
            <div class="profile-widget-item">
              <div class="profile-widget-item-label">Kelas</div>
              <div class="profile-widget-item-value">{{ $getUser->grade->name }}</div>
            </div>
            <div class="profile-widget-item">
              <div class="profile-widget-item-label">Program Jurusan</div>
              <div class="profile-widget-item-value">{{ $getUser->studyProgram->name }}</div>
            </div>
            <div class="profile-widget-item">
              <div class="profile-widget-item-label">Status Siswa</div>
              <div class="profile-widget-item-value text-capitalize">{{ $getUser->scholarship->name }}</div>
            </div>
          </div>
        </div>
        <div class="profile-widget-description pb-0">
          <div class="profile-widget-name">
            <h4>{{ $getUser->user->name }}
              <div class="text-muted d-inline font-weight-normal">
                <div class="slash"></div> {{ $getUser->nis }}
              </div>
            </h4>
          </div>
          <hr>

          <div class="card-body">
            <form action="{{ route('student.profile.update', $getUser->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="name">Nama</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ $getUser->user->name }}" placeholder="Nama">
                  @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group col-md-6">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{ $getUser->user->email }}"
                    placeholder="Email">
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="whatsapp">No. Whatsapp</label>
                  <input type="tel" class="form-control @error('whatsapp') is-invalid @enderror" id="whatsapp"
                    name="whatsapp" value="{{ $getUser->whatsapp }}" placeholder="whatsapp">
                  @error('whatsapp')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group col-md-6">
                  <label for="whatsapp_parent">No. Whatsapp Orang Tua / Wali</label>
                  <input type="tel" class="form-control @error('whatsapp_parent') is-invalid @enderror"
                    id="whatsapp_parent" name="whatsapp_parent" value="{{ $getUser->whatsapp_parent }}"
                    placeholder="whatsapp_parent">
                  @error('whatsapp_parent')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Update</button>
              &nbsp;
              <a href="{{ route('student.profile.password', $getUser->id) }}" class="btn btn-outline-warning">Ganti
                Password</a>
            </form>
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