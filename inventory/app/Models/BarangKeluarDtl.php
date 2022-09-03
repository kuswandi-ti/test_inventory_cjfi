<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarDtl extends Model
{
    use HasFactory;

    protected $table        = 'barang_keluar_dtl';
    protected $primaryKey   = 'id';

    protected $fillable = [
        'id_header', 'kode_barang', 'qty'
    ];
}
