@extends('template')
@section('content')
    <div class="section-body">
        <h2 class="section-title">{{ $page_title }}</h2>
        <p class="section-lead">{{ $page_desc }}</p>

        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Data Barang Masuk (Header)</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('barangmasuk_storehdr') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label>Nomor Transaksi</label>
                                <input type="text" class="form-control" id="nomor_dokumen" name="nomor_dokumen" value="{{ old('nomor_dokumen') }}" placeholder="AUTO" readonly>
                            </div>
                            <div class="form-group">
                                <label>Tgl Dokumen (yyyy-mm-dd)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" id="tgl_dokumen" name="tgl_dokumen" value="{{ old('tgl_dokumen') }}" readonly>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                    </div>
                                </div>
                                @if($errors->has('tgl_dokumen'))
                                    <p class="text-danger">{{ $errors->first('tgl_dokumen') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" id="keterangan" name="keterangan" maxlength="255" value="{{ old('keterangan') }}">
                                @if($errors->has('keterangan'))
                                    <p class="text-danger">{{ $errors->first('keterangan') }}</p>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Header & Isi Detail</button>
                        </form>
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

            $('#tgl_dokumen').datepicker({
                format:'yyyy-mm-dd',
            }).datepicker("setDate",'now');
        });
    </script>
@endsection
