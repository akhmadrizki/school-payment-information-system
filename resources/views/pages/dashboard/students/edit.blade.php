@extends('layouts.dashboard')

@section('title', 'Edit Data Siswa')

@section('custom-css')

@endsection

@section('main-content')
<div class="section-header">
  <h1>Edit Data Siswa</h1>
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

      <div class="card">
        <div class="card-body">
          <form action="{{ route('siswa.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="nis">NIS</label>
                <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" id="nis"
                  value="{{ $student->nis }}" readonly>
                @error('nis')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label for="name">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                  value="{{ $student->user->name }}" placeholder="Nama">
                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ $student->user->email }}"
                  placeholder="Alamat Email">
              </div>
              <div class="form-group col-md-4">
                <label for="study_program">Jurusan</label>
                <select name="study_program" id="study_program" class="form-control">
                  <option value="none" selected disabled>- Pilih Jurusan -</option>
                  @foreach ($studyPrograms as $studyProgram)
                  <option value="{{ $studyProgram->id }}" @if($student->study_program_id == $studyProgram->id) selected
                    @endif>{{
                    $studyProgram->name }}
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="grade">Kelas</label>
                <select name="grade" id="grade" class="form-control">
                  <option value="none" selected disabled>- Pilih Kelas -</option>
                  @foreach ($grades as $grade)
                  <option value="{{ $grade->id }}" @if($student->grade_id == $grade->id) selected @endif>{{ $grade->name
                    }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="scholarship">Beasiswa</label>
                <select name="scholarship" id="scholarship" class="form-control">
                  <option value="none" selected disabled>- Pilih Jenis Beasiswa -</option>
                  @foreach ($scholarships as $scholarship)
                  <option value="{{ $scholarship->id }}" @if($student->scholarship_id == $scholarship->id) selected
                    @endif>{{ $scholarship->name
                    }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group col-md-6">
                <label for="whatsapp">No Whatsapp</label>
                <input type="tel" class="form-control @error('whatsapp') is-invalid @enderror" name="whatsapp"
                  id="whatsapp" value="{{ $student->whatsapp }}" placeholder="Nomor Whatsapp">
                @error('whatsapp')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="whatsapp_parent">No Whatsapp Orang Tua/Wali</label>
                <input type="tel" class="form-control @error('whatsapp_parent') is-invalid @enderror"
                  name="whatsapp_parent" id="whatsapp_parent" value="{{ $student->whatsapp_parent }}"
                  placeholder="Nomor Whatsapp Orang Tua/Wali">
                @error('whatsapp_parent')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="text-right">
              <button type="submit" class="btn btn-primary mr-2">Save</button>
              <a href="{{ url()->previous() }}" type="button" class="btn">Cancel</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection