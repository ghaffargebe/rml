@extends('layouts.app')

@section('content')
<div class="container" id="subhead" style="padding-left: 0;padding-right: 0;">
    <div style="padding:10px 0"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 h3topclear">
                <h3 class="h3topclear"><b>Dataset Detail</b></h3>
                <p style="margin-bottom: 24px;">Terkait Sistem Repository Metadata dan Direktori Layanan</p>
            </div>
            <div class="col-sm-12" id="article">
                <div class="back-white col-sm-12">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">System Description</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Data Description</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Service Description</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                            <h3>Deskripsi Sistem</h3>
                            <i>PERATURAN MENTERI KOMUNIKASI DAN INFORMATIKA REPUBLIK INDONESIA Pasal 8 Ayat (2) dan (3)</i>
                            <div class="separator"></div>
                            <h4>Instansi Penyedia Layanan : {{ $dataset->organisasi }}</h4>
                            
                            <h4>Alamat Instansi</h4>
                            <div class="separator"></div>
                            <p><?php print_r(strip_tags($dataset->alamat));?></p>
                            <p><?php print_r(strip_tags($dataset->alamat_web));?></p>

                            <h4>Pejabat Pendaftar Sistem Elektronik</h4>
                            <div class="separator"></div>
                            <p><?php print_r(strip_tags($dataset->pejabat));?></p>

                            <h4>Deskripsi Layanan</h4>
                            <div class="separator"></div>
                            <p><?php print_r(strip_tags($dataset->deskripsi));?></p>

                            <h4>Ruang Lingkup Layanan</h4>
                            <div class="separator"></div>
                            <p><?php print_r(strip_tags($dataset->ruang_lingkup));?></p>

                            <h4>Jenis Layanan</h4>
                            <div class="separator"></div>
                            <p><?php print_r(strip_tags($dataset->jenis));?></p>

                            <h4>Fungsi Utama Layanan</h4>
                            <div class="separator"></div>
                            <p><?php print_r(strip_tags($dataset->fungsi_utama));?></p>

                            <h4>Sasaran Layanan</h4>
                            <div class="separator"></div>
                            <p><?php print_r(strip_tags($dataset->sasaran));?></p>

                            <h4>Penanggungjawab Layanan</h4>
                            <div class="separator"></div>
                            <p><?php print_r(strip_tags($dataset->penanggungjawab));?></p>

                            <h4>Kategori Sistem Elektronik</h4>
                            <div class="separator"></div>
                            <p><?php print_r(strip_tags($dataset->kategori));?></p>
                            
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                          <h3>Deskripsi Data</h3>
                          <div class="separator"></div>
                          <table class="table table-bordered">
                            <thead>
                            <tr>
                              <th>Nama Data</th>
                              <th>Jenis Data</th>
                              <th>Kategori Data</th>
                              <th>Wali Data</th>
                            </tr>
                            </thead>
                            <tbody>
                              @for($i=0;$i<count($dataset->nama_data);$i++)
                              <tr>
                                <td>{{ $dataset->nama_data[$i] }}</td>
                                <td>{{ $dataset->jenis_data[$i] }}</td>
                                <td>{{ $kat_data[$dataset->kategori_data[$i]] }}</td>
                                <td>{{ $dataset->wali_data[$i] }}</td>
                              </tr>
                              @endfor
                            </tbody>
                          </table>
                          
                        @if(isset($dataset->filename))
                        <!-- <div class="attachment">
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
                              </div> -->
                        @endif
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                          <h3>Deskripsi Layanan</h3>
                            <div class="separator"></div>
                            <table class="table table-bordered">
                            <thead>
                            <tr>
                              <th>Link API</th>
                              <th>Cara</th>
                            </tr>
                            </thead>
                            <tr>
                              <td>{{ print_r(strip_tags($dataset->linkapi)) }}</td>
                              <td>{{ print_r(strip_tags($dataset->howto)) }}</td>
                            </tr>
                          </table>
                        </div>
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
