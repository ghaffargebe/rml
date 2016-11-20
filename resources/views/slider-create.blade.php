        @extends('layouts.dashboard')
        @section('content')
        <!-- page content -->
          <div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kelola Gambar Slider</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" ng-app="">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Tambah Gambar</h2>
                          <div class="clearfix"></div>
                        </div>
                      <br>

                      @if (session()->has('flash_notification.message'))
                          <div class="alert alert-{{ session('flash_notification.level') }}">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                              {!! session('flash_notification.message') !!}
                          </div>
                      @endif

                        @if(isset($slider))
                            {{ Form::model($slider, ['url' => ['slider', $slider->_id], 'method' => 'patch', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => "multipart/form-data"]) }}
                        @else
                            {{ Form::open(['url' => 'slider', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => "multipart/form-data"]) }}
                        @endif

                        <div class="form-group{{ $errors->has('gambar') ? ' has-error' : '' }}">
                            <label for="gambar" class="col-md-4 control-label">Gambar (Resolusi : 1500x300 px)</label>

                            <div class="col-md-6">
                                <input type="file" name="gambar" class="form-control" required>

                                @if ($errors->has('gambar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gambar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                @if(!isset($slider))
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