@extends('template')
@section('content')
    <div class="section-body">
        <h2 class="section-title">{{ $page_title }}</h2>
        <p class="section-lead">{{ $page_desc }}</p>

        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Data Barang</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('barang.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label>Kode Barang</label>
                                <input type="text" class="form-control" id="kode_barang" name="kode_barang" maxlength="10" value="{{ old('kode_barang') }}">
                                @if($errors->has('kode_barang'))
                                    <p class="text-danger">{{ $errors->first('kode_barang') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Nama Barang</label>
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang" maxlength="255" value="{{ old('nama_barang') }}">
                                @if($errors->has('nama_barang'))
                                    <p class="text-danger">{{ $errors->first('nama_barang') }}</p>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input type="text" class="form-control" id="deskripsi" name="deskripsi" maxlength="255" value="{{ old('deskripsi') }}">
                                @if($errors->has('deskripsi'))
                                    <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
