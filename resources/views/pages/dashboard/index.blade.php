@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('main-content')
<div class="section-header">
  <h1>Dashboard</h1>
</div>

<div class="section-body">
  <div class="row">
    <div class="col-12">
      <div class="hero bg-white text-dark text-center">
        <div class="hero-inner">
          <h2>Welcome, {{ Auth::user()->name }}!</h2>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection