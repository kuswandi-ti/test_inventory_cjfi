<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class StockController extends Controller
{
    function index(Request $request)
    {
        $page_title = 'List Data Stock Barang';
        $page_desc  = 'Halaman List Data Stock Barang';
        $breadcrumb = 'Stock Barang';

        if(request()->ajax()) {
            if(!empty($request->from_date)) {
                $data = DB::table('stock')
                            ->join('barang', 'stock.kode_barang', '=', 'barang.kode_barang')
                            ->select('stock.*', 'barang.nama_barang')
                            ->whereBetween('stock.tgl_dokumen', array($request->from_date, $request->to_date))
							->orderBy('stock.kode_barang', 'ASC')
                            ->orderBy('id', 'DESC')
                            ->get();
            } else {
                $data = DB::table('stock')
                            ->join('barang', 'stock.kode_barang', '=', 'barang.kode_barang')
                            ->select('stock.*', 'barang.nama_barang')
							->orderBy('stock.kode_barang', 'ASC')
                            ->orderBy('id', 'DESC')
                            ->get();
            }
            return datatables()->of($data)->make(true);
        }

        return view('stock.index', compact('page_title', 'page_desc', 'breadcrumb'));
    }
}
