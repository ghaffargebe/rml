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
            <div class="row col-sm-12">
                @foreach($berita as $key)
                <div class="back-white col-sm-12">
                    <h3>{{ $key->judul }}</h3>
                    <div class="separator"></div>
                    <?php print_r(substr(strip_tags($key->isi), 0, 70)); ?>... <a href="{{ url('frontberitadetail/'.$key->_id) }}">Read More</a>
                </div>
                @endforeach
            </div>
            <!-- <div class="col-sm-4">
                <div class="back-white" style="height: 360px; "></div>
            </div> -->
        </div>
    </div>
</div>
@endsection
