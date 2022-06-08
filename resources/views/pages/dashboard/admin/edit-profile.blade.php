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
  <h1>Profil</h1>
</div>

<div class="section-body">
  <div class="row">
    <div class="col-12">

      @if (session('message'))
      <div class="alert alert-success alert-dismissible show fade">
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
        </div>
        <div class="profile-widget-description pb-0">
          <div class="profile-widget-name">
            @if (auth()->user()->role_id == 1)
            <h4 class="text-capitalize">{{ $getUser->name }}</h4>
            @else
            <h4 class="text-capitalize">{{ $getUser->name }}</h4>
            @endif
          </div>
          <hr>

          <div class="card-body">
            <form action="{{ route('staff.profile.update', $getUser->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="username">Username</label>
                  <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                    name="username" value="{{ $getUser->username }}" placeholder="Username">
                  @error('username')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="form-group col-md-4">
                  <label for="name">Nama</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $getUser->name }}"
                    placeholder="Nama">
                </div>
                <div class="form-group col-md-4">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{ $getUser->email }}"
                    placeholder="Email">
                </div>
              </div>

              @if(auth()->user()->role_id == 2)
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="contact">No.Telpn / WA</label>
                  <input type="tel" class="form-control @error('contact') is-invalid @enderror" id="contact"
                    name="contact" value="{{ $getUser->admin->contact }}" placeholder="Nama">
                  @error('contact')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="form-group col-md-6">
                  <label for="address">Alamat</label>
                  <input type="text" class="form-control" id="address" name="address"
                    value="{{ $getUser->admin->address }}" placeholder="Alamat">
                </div>
              </div>

              @endif

              <button type="submit" class="btn btn-primary">Update</button>
              &nbsp;
              <a href="{{ route('staff.profile.password', $getUser->id) }}" class="btn btn-outline-warning">Ganti
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