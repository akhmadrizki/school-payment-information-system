@extends('layouts.dashboard')

@section('title', 'Tambah Data Siswa')

@section('custom-css')

@endsection

@section('main-content')
<div class="section-header">
  <h1>Tambah Data Siswa</h1>
</div>

<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('siswa.store') }}" method="POST">
            @csrf
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="nis">NIS</label>
                <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" id="nis"
                  value="{{ old('nis') }}" placeholder="NIS" required>
                @error('nis')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label for="name">Nama</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                  placeholder="Nama" required>
              </div>
              <div class="form-group col-md-4">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}"
                  placeholder="Alamat Email" required>
              </div>

              <div class="form-group col-md-4">
                <label for="study_program">Jurusan</label>
                <select name="study_program" id="study_program"
                  class="form-control @error('study_program') is-invalid @enderror">
                  <option value="none" selected disabled>- Pilih Jurusan -</option>
                  @foreach ($studyPrograms as $studyProgram)
                  <option value="{{ $studyProgram->id }}">{{ $studyProgram->name }}</option>
                  @endforeach
                </select>
                @error('study_program')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="form-group col-md-4">
                <label for="grade">Kelas</label>
                <select name="grade" id="grade" class="form-control @error('grade') is-invalid @enderror">
                  <option value="none" selected disabled>- Pilih Kelas -</option>
                  @foreach ($grades as $grade)
                  <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                  @endforeach
                </select>
                @error('grade')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="form-group col-md-4">
                <label for="scholarship">Beasiswa</label>
                <select name="scholarship" id="scholarship"
                  class="form-control @error('scholarship') is-invalid @enderror">
                  <option value="none" selected disabled>- Pilih Jenis Beasiswa -</option>
                  @foreach ($scholarships as $scholarship)
                  <option value="{{ $scholarship->id }}" class="text-capitalize">{{ $scholarship->name }}</option>
                  @endforeach
                </select>
                @error('scholarship')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>

              <div class="form-group col-md-6">
                <label for="whatsapp">No Whatsapp</label>
                <input type="tel" class="form-control @error('whatsapp') is-invalid @enderror" name="whatsapp"
                  id="whatsapp" value="{{ old('whatsapp') }}" placeholder="Nomor Whatsapp" required>
                @error('whatsapp')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="whatsapp_parent">No Whatsapp Orang Tua/Wali</label>
                <input type="tel" class="form-control @error('whatsapp_parent') is-invalid @enderror"
                  name="whatsapp_parent" id="whatsapp_parent" value="{{ old('whatsapp_parent') }}"
                  placeholder="Nomor Whatsapp Orang Tua/Wali" required>
                @error('whatsapp_parent')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="text-right">
              <button type="submit" class="btn btn-primary mr-2">Save</button>
              <a href="{{ route('siswa.index') }}" type="button" class="btn">Cancel</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection