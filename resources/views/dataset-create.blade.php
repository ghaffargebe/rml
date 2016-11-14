        @extends('layouts.dashboard')
        @section('content')
        <!-- page content -->
          <div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kelola Dataset</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" ng-app="">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Tambah Dataset</h2>
                          <div class="clearfix"></div>
                        </div>
                      <br>

                      @if (session()->has('flash_notification.message'))
                          <div class="alert alert-{{ session('flash_notification.level') }}">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                              {!! session('flash_notification.message') !!}
                          </div>
                      @endif

                        @if(isset($dataset))
                            {{ Form::model($dataset, ['url' => ['dataset', $dataset->_id], 'method' => 'patch', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => "multipart/form-data"]) }}
                        @else
                            {{ Form::open(['url' => 'dataset', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => "multipart/form-data"]) }}
                        @endif

                        <div class="form-group{{ $errors->has('organisasi') ? ' has-error' : '' }}">
                            <label for="organisasi" class="col-md-4 control-label">Nama Lembaga</label>

                            <div class="col-md-6">
                                <input id="organisasi" type="text" class="form-control" name="organisasi" value="{{ Auth::user()->name }}" readonly>

                                @if ($errors->has('organisasi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('organisasi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
                            <label for="deskripsi" class="col-md-4 control-label">Deskripsi</label>

                            <div class="col-md-6">
                                <textarea id="deskripsi" class="form-control" name="deskripsi" style="resize:vertical;height: 150px;">{{ (isset($dataset)) ?  $dataset->deskripsi  : '' }}</textarea>

                                @if ($errors->has('deskripsi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('deskripsi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tanggal') ? ' has-error' : '' }}">
                            <label for="tanggal" class="col-md-4 control-label">Tanggal</label>

                            <div class="col-md-6">
                                <input id="tanggal" type="text" class="form-control tanggal" name="tanggal" data-date-format="dd/mm/yyyy" value="{{ (isset($dataset)) ?  date('d/m/Y', strtotime($dataset->tanggal))  : '' }}">

                                @if ($errors->has('tanggal'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tanggal') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('howto') ? ' has-error' : '' }}">
                            <label for="howto" class="col-md-4 control-label">How to</label>

                            <div class="col-md-6">
                                <textarea id="howto" class="form-control" name="howto" style="resize:vertical;height: 150px;">{{ (isset($dataset)) ?  $dataset->howto  : '' }}</textarea>

                                @if ($errors->has('howto'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('howto') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            <label for="file" class="col-md-4 control-label">File Upload (XLS, JSON, XML)</label>

                            <div class="col-md-6">
                                <input type="file" name="file[]" class="form-control">

                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            <label for="file" class="col-md-4 control-label">File Upload (XLS, JSON, XML)</label>

                            <div class="col-md-6">
                                <input type="file" name="file[]" class="form-control">

                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div id="fileBaru"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                @if(!isset($dataset))
                                <a href="#" class="btn btn-info" onClick="tambahFile()"><i class="fa fa-plus"></i>&nbsp;Tambah File</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-save"></i> Save
                                </button>
                                @else
                                <a href="#" class="btn btn-info" onClick="tambahFile()"><i class="fa fa-plus"></i>&nbsp;Tambah File</a>
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
        <script type="text/javascript">
          $(document).ready(function() {
            $('#nice-select').niceSelect();
          });
          $( function() {
            $( ".tanggal" ).datepicker({ dateFormat: 'dd-mm-yy' });
          } );

          function tambahFile(){
            
          }
        </script>
        @endpush