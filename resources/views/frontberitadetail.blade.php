@extends('layouts.app')

@section('content')
<div class="container" id="subhead" style="padding-left: 0;padding-right: 0;">
    <div style="padding:10px 0"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 h3topclear">
                <h3 class="h3topclear"><b>Berita</b></h3>
                <p style="margin-bottom: 24px;">Terkait Sistem Repository Metadata Library</p>
            </div>
            <div class="col-sm-8" id="article">
                <div class="back-white col-sm-12">
                    <h3>{{ $berita->judul }} <small class="pull-right">{{ date('l, d F Y', strtotime($berita->tanggal)) }}</small></h3>
                    <div class="separator"></div>
                    @if(isset($berita->filename))
                    <div class="col-md-4"><img src="{{ URL::asset('gambarberita/'.$berita->filename) }}" alt="{{ $berita->judul }}" class="img img-responsive" /></div>
                    @endif
                    {{ $berita->isi }}
                </div>
            </div>
            <div class="col-sm-4">
                <div class="back-white" style="height: 360px; "></div>
            </div>
        </div>
    </div>
</div>
@endsection
