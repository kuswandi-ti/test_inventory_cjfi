<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

use App\Helpers\Helper;
use DB;
use DateTime;

use App\Models\Barang;
use App\Models\BarangKeluarHdr;
use App\Models\BarangKeluarDtl;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $page_title         = 'List Data Transaksi Barang Keluar';
        $page_desc          = 'Halaman List Data Transaksi Barang Keluar';
        $breadcrumb         = 'Transaksi Barang Keluar';

        $barang_keluar_hdr   = BarangKeluarHdr::all();

        return view('barang_keluar.barang_keluar_list', compact('page_title', 'page_desc', 'breadcrumb', 'barang_keluar_hdr'));
    }

    public function create_hdr()
    {
        $page_title = 'Tambah Data Transaksi Barang Keluar (Header)';
        $page_desc  = 'Halaman Tambah Data Transaksi Barang Keluar (Header)';
        $breadcrumb = 'Tambah Transaksi Barang Keluar (Header)';

        return view('barang_keluar.barang_keluar_add_hdr', compact('page_title', 'page_desc', 'breadcrumb'));
    }

    public function store_hdr(Request $request)
    {
        $barang_keluar_hdr              = new BarangkeluarHdr();

        $doc_no                         = Helper::create_doc_no('BK', date('m'), date('Y'), 'BARANG_KELUAR');

        $barang_keluar_hdr->no_dokumen  = $doc_no;
        $barang_keluar_hdr->tgl_dokumen = $request->tgl_dokumen;
        $barang_keluar_hdr->keterangan  = $request->keterangan;

        $barang_keluar_hdr->save();

        $id = $barang_keluar_hdr->id;

        return redirect()->route('barangkeluar_createdtl', $id)->with(array('success' => 'Data Transaksi Barang Keluar (Header) berhasil disimpan !!!', 'id_header' => $id));
    }

    public function edit($id)
    {
        $page_title = 'Edit Data Transaksi Barang Keluar';
        $page_desc  = 'Halaman Edit Data Transaksi Barang Keluar';
        $breadcrumb = 'Edit Transaksi Barang Keluar';

        $data_header    = DB::table('barang_keluar_hdr')
                                ->where('id', $id)
                                ->first();
        $data_detail    = DB::table('barang_keluar_dtl')
                                ->where('id_header', $id)
                                ->first();
        $master_barang  = Barang::all();

        return view('barang_keluar.barang_keluar_edit', compact('page_title', 'page_desc', 'breadcrumb', 'data_header', 'data_detail', 'master_barang'));
    }

    public function update_hdr(Request $request, $id)
    {
        $data = [
            'keterangan'    => $request->keterangan,
            'updated_at'    => new DateTime()
        ];

        BarangKeluarHdr::where('id', $id)->update($data);

        return redirect()->route('barangkeluar_index')->with('success', 'Data Transaksi Barang Keluar berhasil disimpan !!!');
    }

    public function create_dtl($id)
    {
        $page_title = 'Tambah Data Transaksi Barang Keluar (Detail)';
        $page_desc  = 'Halaman Tambah Data Transaksi Barang Keluar (Detail)';
        $breadcrumb = 'Tambah Transaksi Barang Keluar (Detail)';

        $data_header    = DB::table('barang_keluar_hdr')
                                ->where('id', $id)
                                ->first();
        $master_barang  = Barang::all();

        return view('barang_keluar.barang_keluar_add_dtl', compact('page_title', 'page_desc', 'breadcrumb', 'data_header', 'master_barang'));
    }

    public function store_dtl(Request $request)
    {
        DB::table('barang_keluar_dtl')->insert([
            'id_header'     => $request->id_header,
            'kode_barang'   => $request->kode_barang,
            'qty'           => $request->qty,
            'created_at'    => new DateTime(),
            'updated_at'    => new DateTime(),
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Data berhasil disimpan'
            ]
        );
    }

    public function list_dtl(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $data   = DB::select('SELECT a.id, a.id_header, a.kode_barang, b.nama_barang, a.qty
                                  FROM barang_keluar_dtl a INNER JOIN barang b ON a.kode_barang = b.kode_barang
                                  WHERE a.id_header = "'.$request->id_header.'"
                                  ORDER BY a.updated_at DESC');
            if ($data) {
                foreach ($data as $key => $row) {
                    $id = $row->id;
                    $output.="<tr>".
                                "<td class='text-center'>".$row->id."</td>".
                                "<td class='text-center'>".$row->kode_barang."</td>".
                                "<td>".$row->nama_barang."</td>".
                                "<td class='text-center'>".$row->qty."</td>".
                                '<td class="text-center">
                                    <a href="#" class="btn btn-danger btn-sm" id="btn_hapus" data-id="'.$id.'" ><i class="fas fa-trash-alt"></i> Delete</a>
                                </td>'.
                            "</tr>";
                }
                return Response($output);
            }
        }
    }

    public function destroy_dtl($id)
    {
        BarangKeluarDtl::find($id)->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]
        );
    }
}
