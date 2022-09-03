@extends('template')
@section('content')
    <div class="section-body">
        <h2 class="section-title">{{ $page_title }}</h2>
        <p class="section-lead">{{ $page_desc }}</p>

        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List Data Transaksi Barang Masuk</h4>
                        <a class="btn btn-info" href="{{ route('barangmasuk_createhdr') }}"><i class="fas fa-plus-square"></i> Tambah</a>
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered color-table info-table" id="data_table_barang" cellspacing="0" width="100%">
                                <tr>
                                    <th width="10%" class="text-center">No. Dokumen</th>
                                    <th width="20%" class="text-center">Tgl. Dokumen (yyyy-mm-dd)</th>
                                    <th width="50%">Keterangan</th>
                                    <th width="20%" class="text-center">Action</th>
                                </tr>
                                @foreach ($barang_masuk_hdr as $bm_hdr)
                                    <tr>
                                        <td class="text-center">{{ $bm_hdr->no_dokumen }}</td>
                                        <td class="text-center">{{ $bm_hdr->tgl_dokumen }}</td>
                                        <td>{{ $bm_hdr->keterangan }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm" href="{{ route('barangmasuk_edit', $bm_hdr->id) }}"><i class="fas fa-pencil-alt"></i> Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
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
    </script>
@endsection
