@extends('layouts.dashboard')

@section('title', ' ' . $master->name)

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
            <h4 class="text-capitalize">{{ $master->name }}</h4>
            @else
            <h4 class="text-capitalize">{{ $master->name }}</h4>
            @endif
          </div>
          <hr>

          <table class="table table-sm">
            <tbody>
              @if (auth()->user()->role_id == 1)
              <tr>
                <th scope="row">Role</th>
                <td>{{ $master->role->name }}</td>
              </tr>
              <tr>
                <th scope="row">Username</th>
                <td>{{ $master->username }}</td>
              </tr>
              <tr>
                <th scope="row">Email</th>
                <td>{{ $master->email }}</td>
              </tr>

              @else
              <tr>
                <th scope="row">Role</th>
                <td>{{ $master->role->name }}</td>
              </tr>
              <tr>
                <th scope="row">Username</th>
                <td>{{ $master->username }}</td>
              </tr>
              <tr>
                <th scope="row">Email</th>
                <td>{{ $master->email }}</td>
              </tr>
              <tr>
                <th scope="row">No. Telpn / WA</th>
                <td>+{{ $master->admin->contact }}</td>
              </tr>
              <tr>
                <th scope="row">Alamat</th>
                <td>{{ $master->admin->address }}</td>
              </tr>
              @endif
            </tbody>
          </table>

        </div>

        <div class="card-footer pt-0">
          <a href="{{ route('staff.profile.edit', $master->id) }}" class="btn btn-icon icon-left btn-primary"><i
              class="far fa-edit"></i> Edit Profil</a>
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