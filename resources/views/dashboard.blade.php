@extends('layouts.dashboard')

@section('content')
<div class="">
  <div class="row top_tiles">
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a href="{{ url('dataset/') }}">
        <div class="tile-stats">
          <div class="icon"><i class="fa fa-university"></i></div>
          <div class="count">{{$dataset}}</div>
          <h3>Total Dataset</h3>
          <p>Manajemen Dataset</p>
        </div>
      </a>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a href="{{ url('berita/') }}">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-check-square-o"></i></div>
          <div class="count">{{$berita}}</div>
        <h3>Total Berita</h3>
        <p>Manajemen Berita</p>
      </div>
      </a>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a href="{{ url('organisasi/') }}">
      <div class="tile-stats">
        <div class="icon" style="top: 16px;right: 48px;"><i class="fa fa-remove"></i></div>
        <div class="count">{{$organisasi}}</div>
        <h3>Total Lembaga</h3>
        <p>Manajemen Data Lembaga</p>
      </div>
      </a>
    </div>
    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a href="{{ url('user/') }}">
      <div class="tile-stats">
        <div class="icon"><i class="fa fa-users"></i></div>
        <div class="count">{{$user}}</div>
        <h3>Total Pengguna</h3>
        <p>Monitoring Data Pengguna</p>
      </div>
      </a>
    </div>
  </div>
</div>
@endsection
