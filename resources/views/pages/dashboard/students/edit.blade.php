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
      <div class="card">
        <div class="card-body">
          <form action="{{ route('siswa.update', $student->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nis">NIS</label>
                <input type="text" class="form-control @error('nis') is-invalid @enderror" name="nis" id="nis"
                  value="{{ $student->nis }}" readonly>
                @error('nis')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label for="name">Nama</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $student->user->name }}"
                  placeholder="Nama">
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