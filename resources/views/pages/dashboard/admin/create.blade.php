@extends('layouts.dashboard')

@section('title', 'Tambah Data Admin')

@section('custom-css')

@endsection

@section('main-content')
<div class="section-header">
  <h1>Tambah Data Admin</h1>
</div>

<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="name">Nama</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                  placeholder="Nama Admin">
              </div>
              <div class="form-group col-md-4">
                <label for="username">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"
                  id="username" value="{{ old('username') }}" placeholder="Username">
                @error('username')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                  value="{{ old('email') }}" placeholder="Email Admin">
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="address">Alamat</label>
                <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}"
                  placeholder="Alamat Tinggal">
              </div>
              <div class="form-group col-md-6">
                <label for="contact">Kontak</label>
                <input type="tel" class="form-control @error('contact') is-invalid @enderror" name="contact"
                  id="contact" value="{{ old('contact') }}" placeholder="No WA/Tlpn">
                @error('contact')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="text-right">
              <button type="submit" class="btn btn-primary mr-2">Save</button>
              <a href="{{ route('admin.index') }}" type="button" class="btn">Cancel</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection