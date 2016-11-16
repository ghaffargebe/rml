        @extends('layouts.dashboard')
        @section('content')
        <!-- page content -->
          <div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Manajemen Instansi</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" ng-app="">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Tambah Instansi</h2>
                          <div class="clearfix"></div>
                        </div>
                      <br>

                      @if (session()->has('flash_notification.message'))
                          <div class="alert alert-{{ session('flash_notification.level') }}">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                              {!! session('flash_notification.message') !!}
                          </div>
                      @endif

                        @if(isset($org))
                            {{ Form::model($org, ['url' => ['organisasi', $org->_id], 'method' => 'patch', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => "multipart/form-data"]) }}
                        @else
                            {{ Form::open(['url' => 'organisasi', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => "multipart/form-data"]) }}
                        @endif

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nama Instansi</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ (isset($org)) ?  $org->name  : '' }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
                            <label for="deskripsi" class="col-md-4 control-label">Deskripsi</label>

                            <div class="col-md-6">
                                <textarea id="deskripsi" class="form-control" name="deskripsi" style="resize:vertical;height: 150px;">{{ (isset($org)) ?  $org->deskripsi  : '' }}</textarea>

                                @if ($errors->has('deskripsi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('deskripsi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            <label for="file" class="col-md-4 control-label">Photo Profile</label>

                            <div class="col-md-6">
                                <input id="file" type="file" name="file" class="form-control">
                                @if(isset($org))
                                <img id="blah" src="{{ url('img/'.$org->fileName) }}" alt="your image" class="img img-responsive" />
                                @else
                                <img id="blah" src="#" alt="your image" class="img img-responsive" style="display:none" />
                                @endif
                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                @if(!isset($org))
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

          function tambahFile(){
            
          }

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