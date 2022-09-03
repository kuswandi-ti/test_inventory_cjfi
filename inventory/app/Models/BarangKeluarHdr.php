<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluarHdr extends Model
{
    use HasFactory;

    protected $table        = 'barang_keluar_hdr';
    protected $primaryKey   = 'id';

    protected $fillable = [
        'no_dokumen', 'tgl_dokumen', 'keterangan'
    ];
}
