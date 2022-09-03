@extends('template')
@section('content')
    <div class="section-body">
        <h2 class="section-title">{{ $page_title }}</h2>
        <p class="section-lead">{{ $page_desc }}</p>

        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Data Stock Barang</h4>
                    </div>
                    <div class="card-body">
                        <div class="row input-daterange">
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input type="text" name="from_date" id="from_date" class="form-control" placeholder="Tgl Dokumen (Dari)" readonly />
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input type="text" name="to_date" id="to_date" class="form-control" placeholder="Tgl Dokumen (Sampai)" readonly />
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <button type="button" name="filter" id="filter" class="btn btn-primary"><i class="fas fa-filter"></i> Filter</button>
                                <button type="button" name="refresh" id="refresh" class="btn btn-success"><i class="fas fa-sync-alt"></i> Refresh</button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered color-table info-table" id="data_table_stock" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th class="text-center">Transaksi</th>
                                        <th class="text-center">No. Dokumen</th>
                                        <th class="text-center">Tgl Dokumen</th>
                                        <th class="text-right">Qty (Awal)</th>
                                        <th class="text-right">Qty (Masuk)</th>
                                        <th class="text-right">Qty (Keluar)</th>
                                        <th class="text-right">Qty (Onhand)</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js_file')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        load_data();

        $('#from_date, #to_date').datepicker({
            format:'yyyy-mm-dd',
        }).datepicker("setDate",'now');

        function load_data(from_date = '', to_date = '') {
            $('#data_table_stock').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url     : '{{ route("stock_index") }}',
                    data    : {
                        from_date   : from_date,
                        to_date     : to_date
                    },
                    type    : 'GET'
                },
                columns: [
                    { data: 'kode_barang', name: 'kode_barang' }, // 0
                    { data: 'nama_barang', name: 'nama_barang' }, // 1
                    { data: 'nama_transaksi', name: 'nama_transaksi' }, // 2
                    { data: 'no_dokumen', name: 'no_dokumen' }, // 3
                    { data: 'tgl_dokumen', name: 'tgl_dokumen' }, // 4
                    { data: 'qty_awal', name: 'qty_awal' }, // 5
                    { data: 'qty_masuk', name: 'qty_masul' }, // 6
                    { data: 'qty_keluar', name: 'qty_keluar' }, // 7
                    { data: 'qty_onhand', name: 'qty_onhand' }, // 8
                    { data: 'keterangan_stock', name: 'keterangan_stock' }, // 9
                ],
                'columnDefs': [
                    { "className": "text-center", "targets": [0, 2, 3, 4] },
                    { "className": "text-right", "targets": [5, 6, 7, 8] },
                ],
                'autoWidth': false,
                'responsive': true
            });
        }

        $('#filter').click(function() {
            var from_date   = $('#from_date').val();
            var to_date     = $('#to_date').val();

            if(from_date != '' &&  to_date != '') {
                $('#data_table_stock').DataTable().destroy();
                load_data(from_date, to_date);
            } else {
                alert('Tanggal Dari dan Sampai harus diisi !!!');
            }
        });

        $('#refresh').click(function() {
            $('#data_table_stock').DataTable().destroy();
            load_data();
        });
    </script>
@endsection
