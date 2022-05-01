@extends('layouts.dashboard')

@section('title', 'Tambah Tagihan')

@section('custom-css')

@endsection

@section('main-content')
<div class="section-header">
  <h1>Tambah Tagihan</h1>
</div>

<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <form id="send" action="{{ route('bill.store') }}" method="POST">
            @csrf
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="month">Bulan</label>
                <select name="month" id="month" class="form-control">
                  <option value="none" selected disabled>- Pilih Bulan -</option>
                  <option value="january">Januari</option>
                  <option value="february">Februari</option>
                  <option value="march">Maret</option>
                  <option value="april">April</option>
                  <option value="may">Mei</option>
                  <option value="june">Juni</option>
                  <option value="july">Juli</option>
                  <option value="august">Agustus</option>
                  <option value="september">September</option>
                  <option value="october">Oktober</option>
                  <option value="november">November</option>
                  <option value="december">Desember</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="year">Tahun</label>
                <input type="number" min="0" class="form-control" name="year" id="year" required>
              </div>

              <div class="form-group col-md-4">
                <label for="grade_id">Kelas</label>
                <select name="grade_id" id="grade_id" class="form-control">
                  <option value="none" selected disabled>- Pilih Kelas -</option>
                  @foreach ($grades as $grade)
                  <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="scholarship_id">Beasiswa</label>
                <select name="scholarship_id" id="scholarship_id" class="form-control">
                  <option value="none" selected disabled>- Pilih Jenis Beasiswa -</option>
                  @foreach ($scholarships as $scholarship)
                  <option value="{{ $scholarship->id }}" class="text-capitalize">{{ $scholarship->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="total">Total</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                  </div>
                  <input name="total" id="total" type="number" min="0" class="form-control" required>
                </div>
              </div>

              <div class="form-group col-md-12">
                <label>Deskripsi</label>
                <textarea class="form-control" style="height: 150px" name="description"
                  placeholder="Contoh: Pembayaran SPP bulan april 2022" required></textarea>
              </div>
            </div>

            <div class="text-right">
              <button type="submit" id="button" class="btn btn-primary mr-2"
                onclick="return confirm('Apakah Yakin Data Yang Anda Inputkan Sudah Benar ?')">Save</button>
              <a href="{{ url()->previous() }}" type="button" class="btn">Cancel</a>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  $(document).ready(function(){
  $('#send').submit(function(){
    document.getElementById('button').innerHTML = 'Saving...';
    document.getElementById('button').disabled = true;
  });
  });
</script>
@endsection