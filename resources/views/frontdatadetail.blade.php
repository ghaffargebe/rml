@extends('layouts.app')

@section('content')
<div class="container" id="subhead" style="padding-left: 0;padding-right: 0;">
    <div style="padding:10px 0"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 h3topclear">
                <h3 class="h3topclear"><b>Dataset Detail</b></h3>
                <p style="margin-bottom: 24px;">Terkait Sistem Repository Metadata Library</p>
            </div>
            <div class="col-sm-12" id="article">
                <div class="back-white col-sm-12">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Description</a>
                        </li>
                        @if(isset($dataset->howto))
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">How To</a>
                        </li>
                        @endif
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <h3>{{ $dataset->organisasi }}</h3>
                            <div class="separator"></div>
                            <p>{{ strip_tags($d) }}</p>
                            <div class="separator"></div>
                            @if(isset($dataset->linkapi))
                            Link : {{ $dataset->linkapi }}
                            @endif
                            @if(isset($dataset->filename))
                            <div class="attachment">
                                    <p>
                                      <span><i class="fa fa-paperclip"></i> {{count($filename)}} files — </span>
                                      <a href="#">Download all files</a> |
                                    </p>
                                    <ul>
                                    @for($i = 0; $i < count($filename);$i++)
                                      <li>

                                        <div class="file-name">
                                          {{ $filenameori[$i] }} 
                                        </div>

                                        <div class="links">
                                          <a href="{{url('download/'.$filename[$i])}}">Download</a>
                                        </div>
                                      </li>
                                    @endfor

                                    </ul>
                                  </div>
                            @endif
                        </div>
                        @if(isset($dataset->howto))
                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          <h3>How to</h3>
                            <div class="separator"></div>
                          <p>{{ $howto }}</p>
                        </div>
                        @endif
                      </div>
                    </div>


                    
                </div>
            </div>
            <!-- <div class="col-sm-4">
                <div class="back-white" style="height: 360px; "></div>
            </div> -->
        </div>
    </div>
</div>
@endsection
