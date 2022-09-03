@extends('template')
@section('content')
    <div class="section-body">
        <h2 class="section-title">{{ $page_title }}</h2>
        <p class="section-lead">{{ $page_desc }}</p>

        <form id="form_barangmasuk" action="{{ route('barangmasuk_updatehdr', $data_header->id) }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Data Barang Masuk</h4>
                        </div>
                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif

                            <div class="form-row">
                                <input type="hidden" class="form-control" id="id_header" name="id_header" value="{{ $data_header->id }}" readonly>

                                <div class="form-group col-md-2">
                                    <label for="no_dokumen">No. Dokumen</label>
                                    <input type="text" class="form-control" id="no_dokumen" name="no_dokumen" value="{{ $data_header->no_dokumen }}" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="tgl_dokumen">Tgl Dokumen (yyyy-mm-dd)</label>
                                    <input type="text" class="form-control" id="tgl_dokumen" name="tgl_dokumen" value="{{ $data_header->tgl_dokumen }}" readonly>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $data_header->keterangan }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="no_dokumen">Kode Barang</label>
                                    <select class="form-control" id="kode_barang" name="kode_barang">
                                        @foreach ($master_barang as $bm)
                                            <option data-nama="{{ $bm->nama_barang }}" value="{{ $bm->kode_barang }}">{{ $bm->kode_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" readonly>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="qty">Qty</label>
                                    <input type="text" class="form-control" id="qty" name="qty">
                                </div>
                            </div>

                            <a href="#" class="btn btn-icon btn-warning" id="btn_simpan" name="btn_simpan"><i class="fas fa-plus-square"></i> Tambah Detail</a>

                            <br/><br/>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped table-bordered color-table info-table" id="data_table_bm_dtl" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th width="0%" class="text-center">ID</th>
                                                    <th width="20%" class="text-center">Kode Barang</th>
                                                    <th width="60%">Nama Barang</th>
                                                    <th width="10%" class="text-center">Qty</th>
                                                    <th width="10%" class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-icon btn-block btn-info"><i class="fas fa-save"></i> Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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

            load_detail();

            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
            });

            $('#kode_barang').on('change', function() {
                const nama = $('#kode_barang option:selected').data('nama');
                $('[name=nama_barang]').val(nama);

                $('[name=qty]').val(1);
                $('[name=qty]').focus();
            });

            $("#btn_simpan").click(function(e) {
                e.preventDefault();

                var id_header   = $("input[name=id_header]").val();
                var kode_barang = $("input[name=kode_barang]").val();
                var nama_barang = $("input[name=nama_barang]").val();
                var qty         = $("input[name=qty]").val();
                var url         = '{{ url('barangmasuk/store_dtl') }}';

                if (nama_barang.length === 0) {
                    alert('Barang harus dipilih !!!');
                    return;
                }

                if (qty.length === 0) {
                    alert('Qty harus diisi !!!');
                    return;
                }

                $.ajax({
                    url : url,
                    method : 'POST',
                    data : $('#form_barangmasuk').serialize(),
                    success : function(response) {
                        if (response.success) {
                            load_detail();
                        } else {
                            alert("Error")
                        }
                    },
                    error : function(error) {
                        console.log(error)
                    }
                });
            });

            $('body').on('click', '#btn_hapus', function (e) {
                e.preventDefault();

                var id          = $(this).data("id");
                var url         = '{{ url('barangmasuk/destroy_dtl') }}';
                var url_delete  = url + "/" + id;

                $.ajax({
                    url : url_delete,
                    type: 'DELETE',
                    success : function(response) {
                        if (response.success) {
                            load_detail();
                        } else {
                            alert("Error")
                        }
                    },
                    error : function(error) {
                        console.log(error)
                    }
                });
            });

            function load_detail() {
                var id_header = $("input[name=id_header]").val();
                $.ajax({
                    type    : 'get',
                    url     : '{{ URL::to('barangmasuk/list_dtl') }}',
                    data    : {
                        'id_header' : id_header
                    },
                    success : function(data) {
                        $('tbody').html(data);
                    }
                });
            }
        });
    </script>
@endsection
