@extends('layouts.app')

@section('content')
<div class="container" id="subhead">
            <div class="row">
                <div class="col-xs-12" style="height:100px; color: #0060AA">
                    <h3><b>List Dataset</b></h3>
                    <p>Daftar Seluruh Dataset Terintegrasi</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="back-white" style="margin-bottom: 24px; padding: 24px;">
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <select id="filter" class="form-control" onChange="filter()">
                                    <option value="" selected>-- Filter ALL --</option>
                                    @foreach($org as $key)
                                    <option value="{{ $key->name }}">{{ $key->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="separator-text"></div>
                        
                        <table id="table" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Penyedia</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="back-white" style="height: 400px; margin-bottom: 24px"></div>
                </div>
            </div>
        </div>
@endsection

@push('scripts')
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script>
var table;
        $(document).ready(function() {
            var val = $('#filter').val();
            if (val == "") {
                val = 1;
            };
            table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ URL::to('getFrontDataset') }}/"+val,
                columns: [
                    // { data: '_id', name: '_id' },
                    { data: 'organisasi', name: 'organisasi' },
                    { data: 'deskripsi', name: 'deskripsi' },
                    { data: 'tanggal', name: 'tanggal' },
                    { data: 'tipe', name: 'tipe' },
            ]
            });
          });

        function filter(){
            table.destroy();
            var val = $('#filter').val();
            if (val == "") {
                val = 1;
            };
            table = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ URL::to('getFrontDataset') }}/"+val,
                columns: [
                    // { data: '_id', name: '_id' },
                    { data: 'organisasi', name: 'organisasi' },
                    { data: 'deskripsi', name: 'deskripsi' },
                    { data: 'tanggal', name: 'tanggal' },
                    { data: 'tipe', name: 'tipe' },
            ]
            });
        }
</script>
@endpush