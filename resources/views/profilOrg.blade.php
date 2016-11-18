@extends('layouts.app')

@section('content')
<div class="container" id="subhead" style="padding-left: 0;padding-right: 0;">
    <div style="padding:10px 0"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 h3topclear">
                <h3 class="h3topclear"><b>Organisasi</b></h3>
                <p style="margin-bottom: 24px;">Terkait Sistem Repository Metadata Library</p>
            </div>
            <div class="col-sm-12" id="article">
                <div class="back-white col-sm-12">
                    <h3>{{ $org[0]->name }}</h3>
                    <div class="separator"></div>
                    @if(isset($org[0]->fileName))
                    <div class="col-md-4"><img src="{{ url('img/'.$org[0]->fileName) }}" alt="{{ $org[0]->name }}" class="img img-responsive" /></div>
                    @endif
                    {{ $org[0]->deskripsi }}
                </div>
            </div>
            <!-- <div class="col-sm-4">
                <div class="back-white" style="height: 360px; "></div>
            </div> -->
        </div>
    </div>
</div>
@endsection
