        @extends('layouts.dashboard')
        @section('content')
        <!-- page content -->
          <div>
            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kelola Pengguna</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" ng-app="">
                    <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Tambah Pengguna</h2>
                          <div class="clearfix"></div>
                        </div>
                      <br>

                      @if (session()->has('flash_notification.message'))
                          <div class="alert alert-{{ session('flash_notification.level') }}">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                              {!! session('flash_notification.message') !!}
                          </div>
                      @endif

                        @if(isset($user))
                            {{ Form::model($user, ['url' => ['user', $user->_id], 'method' => 'patch', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => "multipart/form-data"]) }}
                        @else
                            {{ Form::open(['url' => 'user', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => "multipart/form-data"]) }}
                        @endif

                        <div class="form-group{{ $errors->has('organisasi') ? ' has-error' : '' }}">
                            <label for="organisasi" class="col-md-4 control-label">Nama Instansi</label>

                            <div class="col-md-6">
                                <!-- <input id="organisasi" type="text" class="form-control" name="organisasi" value="{{ (isset($user)) ?  $user->organisasi  : '' }}"> -->
                                @if(isset($user))
                                {{ Form::select('organisasi', $lembaga, $user->organisasi, ['placeholder' => 'Please Select...', 'class' => 'form-control']) }}
                                @else
                                {{ Form::select('organisasi', $lembaga, null, ['placeholder' => 'Please Select...', 'class' => 'form-control']) }}
                                @endif
                                @if ($errors->has('organisasi'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('organisasi') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ (isset($user)) ?  $user->username  : '' }}">

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ (isset($user)) ?  $user->email  : '' }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            <label for="file" class="col-md-4 control-label">Photo Profile</label>

                            <div class="col-md-6">
                                <input id="file" type="file" name="file" class="form-control">
                                @if(isset($user))
                                <img id="blah" src="{{ url('images/'.$user->filename) }}" alt="your image" class="img img-responsive" />
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

                        <!-- Field Jenis dan Lembaga tingkat User Biasa -->
                        <input type="hidden" name="jenis" value="1">
                        <!-- END Field Jenis dan Lembaga tingkat User Biasa -->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                @if(!isset($user))
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Register
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
        <script type="text/javascript">
          $(document).ready(function() {
            $('#nice-select').niceSelect();
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