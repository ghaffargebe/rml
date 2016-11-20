        @extends('layouts.dashboard')
        @section('content')
        <!-- page content -->
          <div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kelola Berita</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" ng-app="">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Tambah Berita</h2>
                          <div class="clearfix"></div>
                        </div>
                      <br>

                      @if (session()->has('flash_notification.message'))
                          <div class="alert alert-{{ session('flash_notification.level') }}">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                              {!! session('flash_notification.message') !!}
                          </div>
                      @endif

                        @if(isset($berita))
                            {{ Form::model($berita, ['url' => ['berita', $berita->_id], 'method' => 'patch', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => "multipart/form-data"]) }}
                        @else
                            {{ Form::open(['url' => 'berita', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => "multipart/form-data"]) }}
                        @endif

                        <div class="form-group{{ $errors->has('judul') ? ' has-error' : '' }}">
                            <label for="judul" class="col-md-4 control-label">Judul</label>

                            <div class="col-md-6">
                                <input id="judul" type="text" class="form-control" name="judul" value="{{ (isset($berita)) ?  $berita->judul  : '' }}">

                                @if ($errors->has('judul'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('judul') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('isi') ? ' has-error' : '' }}">
                            <label for="isi" class="col-md-4 control-label">Isi</label>

                            <div class="col-md-6">
                                <textarea id="isi" class="form-control mytextarea" name="isi" style="resize:vertical;height: 150px;">{{ (isset($berita)) ?  $berita->isi  : '' }}</textarea>

                                @if ($errors->has('isi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('isi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('gambar') ? ' has-error' : '' }}">
                            <label for="gambar" class="col-md-4 control-label">Gambar (JPG, JPEG, PNG)</label>

                            <div class="col-md-6">
                                <input id="file" type="file" name="gambar" class="form-control">
                                @if(isset($berita->filename))
                                <img id="blah" src="{{ url('gambarberita/'.$berita->filename) }}" alt="your image" class="img img-responsive" />
                                @else
                                <img id="blah" src="#" alt="your image" class="img img-responsive" style="display:none" />
                                @endif

                                @if ($errors->has('gambar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gambar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tanggal') ? ' has-error' : '' }}">
                            <label for="tanggal" class="col-md-4 control-label">Tanggal</label>

                            <div class="col-md-6">
                                <input id="tanggal" type="text" class="form-control tanggal" name="tanggal" data-date-format="dd/mm/yyyy" value="{{ (isset($berita)) ?  date('d/m/Y', strtotime($berita->tanggal))  : date('d/m/Y') }}">

                                @if ($errors->has('tanggal'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tanggal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                @if(!isset($berita))
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-save"></i> Save
                                </button>
                                @else
                                <button type="submit" class="btn btn-warning">
                                    <i class="fa fa-btn fa-pencil"></i> Edit
                                </button>
                                @endif
                            </div>
                        </div>
                    </form>
                      </div>
                    </div>
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

          function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#blah').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#file").change(function(){
                $('#blah').show();
                readURL(this);
            });
        </script>
        @endpush