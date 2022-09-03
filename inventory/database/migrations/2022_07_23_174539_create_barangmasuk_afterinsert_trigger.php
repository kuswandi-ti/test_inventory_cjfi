<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangmasukAfterinsertTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER `trg_barangmasuk_afterinsert`
            AFTER INSERT ON `barang_masuk_dtl` FOR EACH ROW
            BEGIN
                DECLARE v_nama_transaksi VARCHAR(50);
                DECLARE v_qty_onhand INTEGER;
                DECLARE v_qty_balance INTEGER;
                DECLARE v_no_dokumen VARCHAR(50);
                DECLARE v_tgl_dokumen DATE;

                SET v_nama_transaksi = "BARANG MASUK";
                /*
                    1. Dapatkan stok terakhir
                    2. Tambahkan stok terakhir dengan qty baru
                */
                IF EXISTS (SELECT `qty_onhand`
                           FROM `stock`
                           WHERE `kode_barang` = NEW.kode_barang
                           ORDER BY `id` DESC
                           LIMIT 1) THEN
                    SET v_qty_onhand = (SELECT `qty_onhand`
                                        FROM `stock`
                                        WHERE `kode_barang` = NEW.kode_barang
                                        ORDER BY id DESC
                                        LIMIT 1);
                ELSE
                    SET v_qty_onhand = 0;
                END IF;

                IF EXISTS (SELECT `no_dokumen`, `tgl_dokumen`
                           FROM `barang_masuk_hdr`
                           WHERE `id` = NEW.id_header
                           LIMIT 1) THEN
                    SET v_no_dokumen = (SELECT `no_dokumen`
                                        FROM `barang_masuk_hdr`
                                        WHERE `id` = NEW.id_header
                                        LIMIT 1);
                    SET v_tgl_dokumen = (SELECT `tgl_dokumen`
                                        FROM `barang_masuk_hdr`
                                        WHERE `id` = NEW.id_header
                                        LIMIT 1);
                ELSE
                    SET v_no_dokumen = NULL;
                    SET v_tgl_dokumen = NULL;
                END IF;

                SET v_qty_balance = v_qty_onhand + NEW.qty;

                /* Tambahkan stok */
                INSERT INTO `stock` (`no_dokumen`, `tgl_dokumen`, `nama_transaksi`, `kode_barang`, `keterangan_stock`, `qty_awal`, `qty_masuk`, `qty_keluar`, `qty_onhand`, created_at, updated_at)
                VALUES (v_no_dokumen, v_tgl_dokumen, v_nama_transaksi, NEW.kode_barang, concat("Penambahan Stock sebanyak : ", NEW.qty), v_qty_onhand, NEW.qty, 0, v_qty_balance, NOW(), NOW());
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DROP TRIGGER `trg_barangmasuk_afterinsert`');
    }
}
