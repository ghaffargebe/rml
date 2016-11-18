@extends('layouts.app')

@section('content')
<div class="container-fluid" id="subhead" style="padding-left: 0;padding-right: 0; height: 320px">
    <!-- <div style="background-color: #CCC; height: 320px"></div> -->
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="{{ asset('images/slider1.jpg')}}" alt="slider1" style="height: 280px; width: 1500px">
      <div class="carousel-caption">
      </div>
    </div>
    <div class="item ">
      <img src="{{ asset('images/slider2.jpg')}}" alt="slider2">
      <div class="carousel-caption">
      </div>
    </div>
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12" style="height:100px; color: #0060AA">
            <h3><b>Open Data Organisasi</b></h3>
            <p>Terintegrasi dalam Sistem</p>
        </div>
    </div>
    <div class="row" id="listorg">
        @foreach($org as $key)
        <div class="col-sm-3">
            <div class="listorg" style="background: url({{ asset('img/'.$key->fileName) }}) no-repeat center center white;background-size: 100%">
                <a href="{{ URL::to('profil/'.$key->name) }}"><div class="circle-shape"><span class="glyphicon glyphicon-link"></span></div></a>
            </div>
            <div class="back-white col-sm-12">
                <h4>{{$key->name}}</h4>
                <p>Integrasi : {{ date('d F Y', strtotime($key->created_at)) }}</p>
            </div>
        </div>
        @endforeach
    </div>
    @foreach($berita as $brt)
    <div class="row">
        <div class="col-sm-12 h3topclear">
            <h3 class="h3topclear"><b>Artikel & Informasi</b></h3>
            <p style="margin-bottom: 24px;">Terkait Sistem Repository Metadata Library</p>
        </div>
        <div class="col-sm-12" id="article">
            <div class="back-white col-sm-12">
                <h3>{{ $brt->judul }} &nbsp;<small><label class="label label-danger">HEADLINE</label></small><small class="pull-right">{{ date('l, d F Y', strtotime($brt->tanggal)) }}</small></h3>
                <div class="separator"></div>
                @if(isset($brt->filename))
                    <div class="col-md-4"><img src="{{ URL::asset('gambarberita/'.$brt->filename) }}" alt="{{ $brt->judul }}" class="img img-responsive" /></div>
                @endif
                {!! $brt->isi !!}
            </div>
        </div>
        <!-- <div class="col-sm-4">
            <div class="back-white" style="height: 360px; "></div>
        </div> -->
    </div>
    @endforeach
</div>
@endsection

