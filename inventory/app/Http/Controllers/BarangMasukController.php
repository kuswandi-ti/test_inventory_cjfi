<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

use App\Helpers\Helper;
use DB;
use DateTime;

use App\Models\Barang;
use App\Models\BarangMasukHdr;
use App\Models\BarangMasukDtl;

class BarangMasukController extends Controller
{
    public function index()
    {
        $page_title         = 'List Data Transaksi Barang Masuk';
        $page_desc          = 'Halaman List Data Transaksi Barang Masuk';
        $breadcrumb         = 'Transaksi Barang Masuk';

        $barang_masuk_hdr   = BarangMasukHdr::all();

        return view('barang_masuk.barang_masuk_list', compact('page_title', 'page_desc', 'breadcrumb', 'barang_masuk_hdr'));
    }

    public function create_hdr()
    {
        $page_title = 'Tambah Data Transaksi Barang Masuk (Header)';
        $page_desc  = 'Halaman Tambah Data Transaksi Barang Masuk (Header)';
        $breadcrumb = 'Tambah Transaksi Barang Masuk (Header)';

        return view('barang_masuk.barang_masuk_add_hdr', compact('page_title', 'page_desc', 'breadcrumb'));
    }

    public function store_hdr(Request $request)
    {
        $barang_masuk_hdr               = new BarangMasukHdr();

        $doc_no                         = Helper::create_doc_no('BM', date('m'), date('Y'), 'BARANG_MASUK');

        $barang_masuk_hdr->no_dokumen   = $doc_no;
        $barang_masuk_hdr->tgl_dokumen  = $request->tgl_dokumen;
        $barang_masuk_hdr->keterangan   = $request->keterangan;

        $barang_masuk_hdr->save();

        $id = $barang_masuk_hdr->id;

        return redirect()->route('barangmasuk_createdtl', $id)->with(array('success' => 'Data Transaksi Barang Masuk (Header) berhasil disimpan !!!', 'id_header' => $id));
    }

    public function edit($id)
    {
        $page_title = 'Edit Data Transaksi Barang Masuk';
        $page_desc  = 'Halaman Edit Data Transaksi Barang Masuk';
        $breadcrumb = 'Edit Transaksi Barang Masuk';

        $data_header    = DB::table('barang_masuk_hdr')
                                ->where('id', $id)
                                ->first();
        $data_detail    = DB::table('barang_masuk_dtl')
                                ->where('id_header', $id)
                                ->first();
        $master_barang  = Barang::all();

        return view('barang_masuk.barang_masuk_edit', compact('page_title', 'page_desc', 'breadcrumb', 'data_header', 'data_detail', 'master_barang'));
    }

    public function update_hdr(Request $request, $id)
    {
        $data = [
            'keterangan'    => $request->keterangan,
            'updated_at'    => new DateTime()
        ];

        BarangMasukHdr::where('id', $id)->update($data);

        return redirect()->route('barangmasuk_index')->with('success', 'Data Transaksi Barang Masuk berhasil disimpan !!!');
    }

    public function create_dtl($id)
    {
        $page_title = 'Tambah Data Transaksi Barang Masuk (Detail)';
        $page_desc  = 'Halaman Tambah Data Transaksi Barang Masuk (Detail)';
        $breadcrumb = 'Tambah Transaksi Barang Masuk (Detail)';

        $data_header    = DB::table('barang_masuk_hdr')
                                ->where('id', $id)
                                ->first();
        $master_barang  = Barang::all();

        return view('barang_masuk.barang_masuk_add_dtl', compact('page_title', 'page_desc', 'breadcrumb', 'data_header', 'master_barang'));
    }

    public function store_dtl(Request $request)
    {
        DB::table('barang_masuk_dtl')->insert([
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
                                  FROM barang_masuk_dtl a INNER JOIN barang b ON a.kode_barang = b.kode_barang
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
        BarangMasukDtl::find($id)->delete();
        return response()->json(
            [
                'success' => true,
                'message' => 'Data berhasil dihapus'
            ]
        );
    }
}
