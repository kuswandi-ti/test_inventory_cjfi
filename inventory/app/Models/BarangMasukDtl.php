<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasukDtl extends Model
{
    use HasFactory;

    protected $table        = 'barang_masuk_dtl';
    protected $primaryKey   = 'id';

    protected $fillable = [
        'id_header', 'kode_barang', 'qty'
    ];
}
