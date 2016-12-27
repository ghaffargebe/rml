        @extends('layouts.dashboard')
        @section('content')
        <!-- page content -->
          <div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Kelola Dataset</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-xs-3">
                      <!-- required for floating -->
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs tabs-left">
                        <li class="active"><a href="#sistem" data-toggle="tab">Deskripsi Sistem</a>
                        </li>
                        <li><a href="#data" data-toggle="tab">Deskripsi Data</a>
                        </li>
                        <li><a href="#layanan" data-toggle="tab">Deskripsi Layanan</a>
                        </li>
                      </ul>
                    </div>

                    @if(isset($dataset))
                        {{ Form::model($dataset, ['url' => ['dataset', $dataset->_id], 'method' => 'patch', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => "multipart/form-data"]) }}
                    @else
                        {{ Form::open(['url' => 'dataset', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => "multipart/form-data"]) }}
                    @endif

                    <div class="col-xs-9">
                      <!-- Tab panes -->
                      <div class="tab-content">
                        <div class="tab-pane active" id="sistem">
                            <p class="lead">Tambah Dataset - Deskripsi Sistem</p>
                            @if (session()->has('flash_notification.message'))
                                  <div class="alert alert-{{ session('flash_notification.level') }}">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                                      {!! session('flash_notification.message') !!}
                                  </div>
                              @endif

                                <div class="form-group{{ $errors->has('organisasi') ? ' has-error' : '' }}">
                                    <label for="organisasi" class="col-md-4 control-label">Instansi Penyedia Layanan</label>

                                    <div class="col-md-6">
                                        <input id="organisasi" type="text" class="form-control" name="organisasi" value="{{ (Auth::user()->organisasi != '') ? Auth::user()->organisasi : $dataset->organisasi}}" readonly>

                                        @if ($errors->has('organisasi'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('organisasi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('alamat') ? ' has-error' : '' }}">
                                    <label for="alamat" class="col-md-4 control-label">Alamat Instansi</label>

                                    <div class="col-md-6">
                                        <textarea id="alamat" class="form-control" name="alamat" style="resize:vertical;height: 100px;">{{ (isset($dataset)) ?  $dataset->alamat  : '' }}</textarea>

                                        @if ($errors->has('alamat'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('alamat') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('alamat_web') ? ' has-error' : '' }}">
                                    <label for="alamat_web" class="col-md-4 control-label">Alamat Situs Instansi</label>

                                    <div class="col-md-6">
                                        <input id="alamat_web" type="text" class="form-control" name="alamat_web" value="{{ (isset($dataset)) ?  $dataset->alamat_web  : '' }}" >

                                        @if ($errors->has('alamat_web'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('alamat_web') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('pejabat') ? ' has-error' : '' }}">
                                    <label for="pejabat" class="col-md-4 control-label">Pejabat Pendaftar Sistem Elektronik</label>

                                    <div class="col-md-6">
                                        <textarea id="pejabat" class="form-control" name="pejabat" style="resize:vertical;height: 100px;">{{ (isset($dataset)) ?  $dataset->pejabat  : '' }}</textarea>

                                        @if ($errors->has('pejabat'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pejabat') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
                                    <label for="deskripsi" class="col-md-4 control-label">Deskripsi Layanan</label>

                                    <div class="col-md-6">
                                        <textarea id="deskripsi" class="form-control" name="deskripsi" style="resize:vertical;height: 100px;">{{ (isset($dataset)) ?  $dataset->deskripsi  : '' }}</textarea>

                                        @if ($errors->has('deskripsi'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('deskripsi') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('ruang_lingkup') ? ' has-error' : '' }}">
                                    <label for="ruang_lingkup" class="col-md-4 control-label">Ruang Lingkup Layanan</label>

                                    <div class="col-md-6">
                                        <textarea id="ruang_lingkup" class="form-control" name="ruang_lingkup" style="resize:vertical;height: 100px;">{{ (isset($dataset)) ?  $dataset->ruang_lingkup  : '' }}</textarea>

                                        @if ($errors->has('ruang_lingkup'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('ruang_lingkup') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('jenis') ? ' has-error' : '' }}">
                                    <label for="jenis" class="col-md-4 control-label">Jenis Layanan</label>

                                    <div class="col-md-6">
                                        <textarea id="jenis" class="form-control" name="jenis" style="resize:vertical;height: 100px;">{{ (isset($dataset)) ?  $dataset->jenis  : '' }}</textarea>

                                        @if ($errors->has('jenis'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('jenis') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('fungsi_utama') ? ' has-error' : '' }}">
                                    <label for="fungsi_utama" class="col-md-4 control-label">Fungsi Utama Layanan</label>

                                    <div class="col-md-6">
                                        <textarea id="fungsi_utama" class="form-control" name="fungsi_utama" style="resize:vertical;height: 100px;">{{ (isset($dataset)) ?  $dataset->fungsi_utama  : '' }}</textarea>

                                        @if ($errors->has('fungsi_utama'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('fungsi_utama') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('sasaran') ? ' has-error' : '' }}">
                                    <label for="sasaran" class="col-md-4 control-label">Sasaran Layanan</label>

                                    <div class="col-md-6">
                                        <textarea id="sasaran" class="form-control" name="sasaran" style="resize:vertical;height: 100px;">{{ (isset($dataset)) ?  $dataset->sasaran  : '' }}</textarea>

                                        @if ($errors->has('sasaran'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('sasaran') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('penganggungjawab') ? ' has-error' : '' }}">
                                    <label for="penganggungjawab" class="col-md-4 control-label">Penanggungjawab Layanan</label>

                                    <div class="col-md-6">
                                        <textarea id="penganggungjawab" class="form-control" name="penganggungjawab" style="resize:vertical;height: 100px;">{{ $dataset->penganggungjawab or '' }}</textarea>

                                        @if ($errors->has('penganggungjawab'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('penganggungjawab') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('kategori') ? ' has-error' : '' }}">
                                    <label for="kategori" class="col-md-4 control-label">Kategori Sistem Elektronik</label>

                                    <div class="col-md-6">
                                        <textarea id="kategori" class="form-control" name="kategori" style="resize:vertical;height: 100px;">{{ (isset($dataset)) ?  $dataset->kategori  : '' }}</textarea>

                                        @if ($errors->has('kategori'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('kategori') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                        </div>
                        <div class="tab-pane" id="data">
                            <p class="lead">Tambah Dataset - Deskripsi Data</p>
                            @if(!isset($dataset))
                            <input type="hidden" id="nomor_data" value="1">
                            <center><h4>Jenis Data 1</h4></center>
                            <div class="form-group">
                                <label for="nama_data" class="col-md-4 control-label">Nama Data</label>
                                <div class="col-md-6">
                                    <input id="nama_data" type="text" class="form-control" name="nama_data[]">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="jenis_data" class="col-md-4 control-label">Jenis Data</label>

                                <div class="col-md-6">
                                    <input id="jenis_data" type="text" class="form-control" name="jenis_data[]" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="kategori_data" class="col-md-4 control-label">Kategori Data</label>
                                <div class="col-md-6">
                                    <select name="kategori_data[]" id="kategori_data" class="form-control">
                                        <option value="">== Pilih ==</option>
                                        <option value="1">Standar</option>
                                        <option value="2">Rahasia</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="wali_data" class="col-md-4 control-label">Wali Data</label>

                                <div class="col-md-6">
                                    <input id="wali_data" type="text" class="form-control" name="wali_data[]" >
                                </div>
                            </div>
                            @else
                            <input type="hidden" id="nomor_data" value="{{count($dataset->nama_data)}}">
                            @for($i = 0; $i < count($dataset->nama_data) ; $i++)
                            <center><h4>Jenis Data {{$i+1}}</h4></center>
                            <div class="form-group">
                                <label for="nama_data" class="col-md-4 control-label">Nama Data</label>
                                <div class="col-md-6">
                                    <input id="nama_data" type="text" class="form-control" name="nama_data[]" value="{{ $dataset->nama_data[$i] }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="jenis_data" class="col-md-4 control-label">Jenis Data</label>

                                <div class="col-md-6">
                                    <input id="jenis_data" type="text" class="form-control" name="jenis_data[]" value="{{ $dataset->jenis_data[$i] }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="kategori_data" class="col-md-4 control-label">Kategori Data</label>
                                <div class="col-md-6">
                                    <select name="kategori_data[]" id="kategori_data" class="form-control">
                                        <option value="">== Pilih ==</option>
                                        @if($dataset->kategori_data[$i] == "1")
                                        <option value="1" selected="selected">Standar</option>
                                        <option value="2">Rahasia</option>
                                        @elseif($dataset->kategori_data[$i] == "2")
                                        <option value="1">Standar</option>
                                        <option value="2" selected="selected">Rahasia</option>
                                        @else
                                        <option value="1">Standar</option>
                                        <option value="2">Rahasia</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="wali_data" class="col-md-4 control-label">Wali Data</label>

                                <div class="col-md-6">
                                    <input id="wali_data" type="text" class="form-control" name="wali_data[]" value="{{ $dataset->wali_data[$i] }}">
                                </div>
                            </div>
                            @endfor
                            @endif

                            <!-- <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                                <label for="file" class="col-md-4 control-label">File Upload</label>

                                <div class="col-md-6">
                                    <input type="file" name="file[]" class="form-control">

                                    @if ($errors->has('file'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div> -->
                            <div id="fileBaru"></div>                                

                            <div class="form-group">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-6">
                                <a href="#" class="btn btn-info" onClick="tambahFile()"><i class="fa fa-plus"></i>&nbsp;Tambah Data</a>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="layanan">
                            <p class="lead">Tambah Dataset - Deskripsi Layanan</p>
                            <div class="form-group{{ $errors->has('linkapi') ? ' has-error' : '' }}">
                                <label for="linkapi" class="col-md-4 control-label">Link API</label>

                                <div class="col-md-6">
                                    <input id="linkapi" type="text" class="form-control" name="linkapi" value="{{ (isset($dataset)) ?  $dataset->linkapi  : '' }}">

                                    @if ($errors->has('linkapi'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('linkapi') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('howto') ? ' has-error' : '' }}">
                                <label for="howto" class="col-md-4 control-label">Cara</label>

                                <div class="col-md-6">
                                    <textarea id="howto" class="form-control" name="howto" style="resize:vertical;height: 100px;">{{ $dataset->howto or '' }}</textarea>

                                    @if ($errors->has('howto'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('howto') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                @if(!isset($dataset))
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-save"></i> Save
                                </button>
                                @else
                                <button type="submit" class="btn btn-warning">
                                    <i class="fa fa-btn fa-pencil"></i> Save Edit
                                </button>
                                @endif
                            </div>
                        </div>
                      </div>
                    </div>
                </form>
                    <div class="clearfix"></div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- /page content -->

        @endsection

        @push('scripts')
        {!! Html::style('vendors/jquery-nice-select/css/nice-select.css'); !!}
        {!! Html::script('vendors/jquery-nice-select/js/jquery.nice-select.js'); !!}
        {!! Html::script('js/tinymce/tinymce.min.js'); !!}
        <script type="text/javascript">
          $(document).ready(function() {
            $('#nice-select').niceSelect();
          });
          $( function() {
            $( ".tanggal" ).datepicker({ dateFormat: 'dd-mm-yy' });
          } );

          tinymce.init({
            selector: '.mytextarea'
          });

          function tambahFile(){
            var nomor = $('#nomor_data').val();
            nomor = parseInt(nomor)+1;
            $('#nomor_data').val(nomor);
            $('#fileBaru').append('<center><h4>Jenis Data '+nomor+'</h4></center>'
                                    +'<div class="form-group">'
                                    +'<label for="nama_data" class="col-md-4 control-label">Nama Data</label>'
                                        +'<div class="col-md-6">'
                                            +'<input id="nama_data" type="text" class="form-control" name="nama_data[]" >'
                                        +'</div>'
                                    +'</div>'

                                    +'<div class="form-group">'
                                        +'<label for="jenis_data" class="col-md-4 control-label">Jenis Data</label>'

                                        +'<div class="col-md-6">'
                                            +'<input id="jenis_data" type="text" class="form-control" name="jenis_data[]" >'
                                        +'</div>'
                                    +'</div>'

                                    +'<div class="form-group">'
                                        +'<label for="kategori_data" class="col-md-4 control-label">Kategori Data</label>'

                                        +'<div class="col-md-6">'
                                            +'<select name="kategori_data[]" id="kategori_data" class="form-control" required>'
                                                +'<option value="">== Pilih ==</option>'
                                                +'<option value="1">Standar</option>'
                                                +'<option value="2">Rahasia</option>'
                                            +'</select>'
                                        +'</div>'
                                    +'</div>'

                                    +'<div class="form-group">'
                                        +'<label for="wali_data" class="col-md-4 control-label">Wali Data</label>'

                                        +'<div class="col-md-6">'
                                            +'<input id="wali_data" type="text" class="form-control" name="wali_data[]" >'
                                        +'</div>'
                                    +'</div>')
          }
        </script>
        @endpush