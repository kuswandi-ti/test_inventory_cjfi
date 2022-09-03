<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->id();
            $table->string('no_dokumen');
            $table->date('tgl_dokumen')->nullable();
            $table->string('nama_transaksi');
            $table->string('kode_barang');
            $table->text('keterangan_stock');
            $table->integer('qty_awal');
            $table->integer('qty_masuk');
            $table->integer('qty_keluar');
            $table->integer('qty_onhand');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock');
    }
}
