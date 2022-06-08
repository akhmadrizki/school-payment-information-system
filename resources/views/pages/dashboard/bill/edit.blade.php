@extends('layouts.dashboard')

@section('title', 'Edit Tagihan')

@section('custom-css')

@endsection

@section('main-content')
<div class="section-header">
  <h1>Edit Tagihan</h1>
</div>

<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('bill.update', $bill->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="month">Bulan</label>
                <select name="month" id="month" class="form-control">
                  <option value="none" selected disabled>- Pilih Bulan -</option>
                  <option value="january" @if($bill->month == 'january') selected @endif>Januari</option>
                  <option value="february" @if($bill->month == 'february') selected @endif>Februari</option>
                  <option value="march" @if($bill->month == 'march') selected @endif>Maret</option>
                  <option value="april" @if($bill->month == 'april') selected @endif>April</option>
                  <option value="may" @if($bill->month == 'mei') selected @endif>Mei</option>
                  <option value="june" @if($bill->month == 'june') selected @endif>Juni</option>
                  <option value="july" @if($bill->month == 'july') selected @endif>Juli</option>
                  <option value="august" @if($bill->month == 'august') selected @endif>Agustus</option>
                  <option value="september" @if($bill->month == 'september') selected @endif>September</option>
                  <option value="october" @if($bill->month == 'october') selected @endif>Oktober</option>
                  <option value="november" @if($bill->month == 'november') selected @endif>November</option>
                  <option value="december" @if($bill->month == 'december') selected @endif>Desember</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="year">Tahun</label>
                <input type="number" min="0" class="form-control" name="year" id="year" value="{{ $bill->year }}"
                  required>
              </div>
              <div class="form-group col-md-6">
                <label for="grade_id">Kelas</label>
                <select name="grade_id" id="grade_id" class="form-control">
                  <option value="none" selected disabled>- Pilih Kelas -</option>
                  @foreach ($grades as $grade)
                  <option value="{{ $grade->id }}" @if($grade->name) selected @endif>{{ $grade->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="total">Total</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">Rp</div>
                  </div>
                  <input name="total" value="{{ $bill->total }}" id="total" type="number" min="0" class="form-control"
                    required>
                </div>
              </div>
              <div class="form-group col-md-12">
                <label>Deskripsi</label>
                <textarea class="form-control" style="height: 150px" name="description"
                  placeholder="Contoh: Pembayaran SPP bulan april 2022" required>
                  {{ $bill->description }}
                </textarea>
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