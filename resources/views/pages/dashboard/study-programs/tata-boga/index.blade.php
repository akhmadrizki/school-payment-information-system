@extends('layouts.dashboard')

@section('title', 'Tata Boga')

@section('custom-css')
<style>
  .pricing .pricing-cta {
    margin: 0;
  }
</style>
@endsection

@section('main-content')
<div class="section-header">
  <h1>Tata Boga</h1>
</div>

<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">

          <div class="row">
            <div class="col-12 col-md-4 col-lg-4">
              <div class="pricing">
                <div class="pricing-title">
                  Kelas
                </div>
                <div class="pricing-padding">
                  <div class="pricing-price">
                    <div>X</div>
                    <div>Tata Boga</div>
                  </div>
                </div>
                <div class="pricing-cta">
                  <a href="#">Lihat Detail <i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-4 col-lg-4">
              <div class="pricing">
                <div class="pricing-title">
                  Kelas
                </div>
                <div class="pricing-padding">
                  <div class="pricing-price">
                    <div>XI</div>
                    <div>Tata Boga</div>
                  </div>
                </div>
                <div class="pricing-cta">
                  <a href="#">Lihat Detail <i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-4 col-lg-4">
              <div class="pricing">
                <div class="pricing-title">
                  Kelas
                </div>
                <div class="pricing-padding">
                  <div class="pricing-price">
                    <div>XII</div>
                    <div>Tata Boga</div>
                  </div>
                </div>
                <div class="pricing-cta">
                  <a href="#">Lihat Detail <i class="fas fa-arrow-right"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection