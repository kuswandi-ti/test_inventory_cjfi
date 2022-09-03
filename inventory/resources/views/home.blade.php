@extends('template')
@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-th-large"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Data Master Barang</h4>
                    </div>
                    <div class="card-body">
                        {{ $count_barang }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-shopping-basket"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Data Transaksi Barang Masuk</h4>
                    </div>
                    <div class="card-body">
                        {{ $count_barang_masuk }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-share-square"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Data Transaksi Barang Keluar</h4>
                    </div>
                    <div class="card-body">
                        {{ $count_barang_keluar }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
