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
                          <h2>Daftar Dataset</h2>
                          <div class="clearfix"></div>
                        </div>
                      @if (session()->has('flash_notification.message'))
                          <div class="alert alert-{{ session('flash_notification.level') }}">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              {!! session('flash_notification.message') !!}
                          </div>
                      @endif

                      	@if(Auth::user()->jenis != 0)
                        <div class="row">
                          <a class="btn btn-primary" href="{{ url('/dataset/create')}}" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Dataset</a>
                      	</div>
                      	@endif
                        <table id="users-table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <!-- <th>ID</th> -->
                              <th>Penyedia Layanan</th>
                              <th>Deskripsi Layanan</th>
                              <th>Jenis Data</th>
                              <th>Link</th>
                              <th>Aksi</th>
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
                ajax: "{{ URL::to('getDataset') }}",
                columns: [
                    // { data: '_id', name: '_id' },
                    { data: 'organisasi', name: 'organisasi' },
                    { data: 'deskripsi', name: 'deskripsi' },
                    { data: 'jenis_data', name: 'jenis_data' },
                    { data: 'linkapi', name: 'linkapi' },
                    { data: 'action', name: 'action' },
                ]
            });
          });


          $(document).on("click", ".btn-delete", function (e){
            e.preventDefault();
            var self = $(this);
            swal({
              title: "Apakah Anda Yakin?",
              text: "Anda akan menghapus salah satu dataset!",
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
                 swal("Deleted!", "Data Berhasil Dihapus", "success");
                 setTimeout(function() {
                        self.parents("form").submit();
                    }, 2000);
              } else {
                swal("Batal", "Proses Telah Dibatalkan", "error");
              }
            });
          });

          $(document).on("click", "#aktif", function (){
            tabrow = $(this).closest('tr');
            status = 1;
            activeInactive(tabrow, status);
          });
          $(document).on("click", "#nonaktif", function (){
            tabrow = $(this).closest('tr');
            status = 0;
            activeInactive(tabrow, status);
          });
          function activeInactive(tab_row, stat_btn) {
            tabrow = table.row( tab_row );
            id_tab = tabrow.data()[0];
            un_tab = tabrow.data()[2];
            $.ajax({
              type: "post",
              url : "",
              data: {id:id_tab,username:un_tab,type:stat_btn},
              success: function(output) {
                swal(
                  'Berhasil!',
                  output,
                  'success'
                );
                table.draw();
              }
            });
            return false;
          }
        </script>

        @endpush