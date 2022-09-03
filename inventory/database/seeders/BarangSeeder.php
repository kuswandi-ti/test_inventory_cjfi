<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('barang')->insert([
            'kode_barang'   => 'B001',
            'nama_barang'   => 'Laptop Core i7',
            'deskripsi'     => 'Laptop spek game',
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('barang')->insert([
            'kode_barang'   => 'B002',
            'nama_barang'   => 'Monitor Lenovo 32 inch',
            'deskripsi'     => 'Monitor komputer dengan layar lebar',
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('barang')->insert([
            'kode_barang'   => 'B003',
            'nama_barang'   => 'Keyboard Logitech',
            'deskripsi'     => 'Keyboard logitech type wireless',
            'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
