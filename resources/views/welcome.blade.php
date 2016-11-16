@extends('layouts.app')

@section('content')
<div class="container-fluid" id="subhead" style="padding-left: 0;padding-right: 0;">
    <div style="background-color: #CCC; height: 320px"></div>
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
                <div class="circle-shape"><span class="glyphicon glyphicon-link"></span></div>
            </div>
            <div class="back-white col-sm-12">
                <h4>{{$key->name}}</h4>
                <p>Integrasi : {{ date('d F Y', strtotime($key->created_at)) }}</p>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-sm-12 h3topclear">
            <h3 class="h3topclear"><b>Artikel & Informasi</b></h3>
            <p style="margin-bottom: 24px;">Terkait Sistem Repository Metadata Library</p>
        </div>
        <div class="col-sm-8" id="article">
            <div class="back-white col-sm-12">
                <h3>{{ $berita[0]->judul }} &nbsp;<small><label class="label label-danger">HEADLINE</label></small><small class="pull-right">{{ date('l, d F Y', strtotime($berita[0]->tanggal)) }}</small></h3>
                <div class="separator"></div>
                @if(isset($berita[0]->filename))
                    <div class="col-md-4"><img src="{{ URL::asset('gambarberita/'.$berita[0]->filename) }}" alt="{{ $berita[0]->judul }}" class="img img-responsive" /></div>
                @endif
                {!! $berita[0]->isi !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="back-white" style="height: 360px; "></div>
        </div>
    </div>
</div>
@endsection
