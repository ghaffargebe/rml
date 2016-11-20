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
                          <h2>Daftar Gambar Slider</h2>
                          <div class="clearfix"></div>
                        </div>
                      @if (session()->has('flash_notification.message'))
                          <div class="alert alert-{{ session('flash_notification.level') }}">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              {!! session('flash_notification.message') !!}
                          </div>
                      @endif
                        <div class="row">
                          <a class="btn btn-primary" href="/slider/create" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Gambar</a>
                      </div>
                        <table id="users-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <!-- <th>ID</th> -->
                              <th class="col-md-3">Gambar</th>
                              <th class="col-md-1">Aksi</th>
                            </tr>
                          </thead>
                        </table>
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
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">

          $(document).ready(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ URL::to('getSlider') }}",
                columns: [
                    // { data: '_id', name: '_id' },
                    { data: 'filename', name: 'filename' },
                    { data: 'action', name: 'action' },
                ]
            });
          });


          $(document).on("click", ".btn-delete", function (e){
            e.preventDefault();
            var self = $(this);
            swal({
              title: "Apakah Anda Yakin?",
              text: "Anda akan menghapus salah satu data berita!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Ya, Hapuskan!",
              cancelButtonText: "Tidak, Batalkan!",
              closeOnConfirm: false,
              closeOnCancel: false
            },
            function(isConfirm){
              if (isConfirm) {
                 // $(this).parents("form").submit();
                 swal("Deleted!", "Berita Berhasil Dihapus", "success");
                 setTimeout(function() {
                        self.parents("form").submit();
                    }, 2000);
              } else {
                swal("Batal", "Proses Telah Dibatalkan", "error");
              }
            });
          });

        </script>

        @endpush