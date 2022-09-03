<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Barang;
use App\Models\BarangMasukHdr;
use App\Models\BarangKeluarHdr;

class HomeController extends Controller
{
    public function index()
	{
        $page_title = 'Dashboard';
        $page_desc  = 'Halaman Dashboard Sistem Inventory';
        $breadcrumb = 'Dashboard';

        $count_barang           = Barang::select("*")->count();
        $count_barang_masuk     = BarangMasukHdr::select("*")->count();
        $count_barang_keluar    = BarangKeluarHdr::select("*")->count();

		return view('home', compact('page_title', 'page_desc', 'breadcrumb', 'count_barang', 'count_barang_masuk', 'count_barang_keluar'));
	}
}
