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
              <div class="form-group col-md-6">
                <label for="nis">NIS</label>
                <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" id="nis"
                  value="{{ old('nis') }}" placeholder="NIS">
                @error('nis')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="name">Nama</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}"
                  placeholder="Nama">
              </div>
              <div class="form-group col-md-4">
                <label for="study_program">Jurusan</label>
                <select name="study_program" id="study_program" class="form-control">
                  <option value="none" selected disabled>- Pilih Jurusan -</option>
                  @foreach ($studyPrograms as $studyProgram)
                  <option value="{{ $studyProgram->id }}">{{ $studyProgram->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="grade">Kelas</label>
                <select name="grade" id="grade" class="form-control">
                  <option value="none" selected disabled>- Pilih Kelas -</option>
                  @foreach ($grades as $grade)
                  <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="scholarship">Beasiswa</label>
                <select name="scholarship" id="scholarship" class="form-control">
                  <option value="none" selected disabled>- Pilih Jenis Beasiswa -</option>
                  @foreach ($scholarships as $scholarship)
                  <option value="{{ $scholarship->id }}" class="text-capitalize">{{ $scholarship->name }}</option>
                  @endforeach
                </select>
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