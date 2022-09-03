<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

use App\Models\Barang;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'List Data Master Barang';
        $page_desc  = 'Halaman List Data Master Barang';
        $breadcrumb = 'Master Barang';

        $barang = Barang::all();

        return view('barang.barang_list', compact('page_title', 'page_desc', 'breadcrumb', 'barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page_title = 'Tambah Data Master Barang';
        $page_desc  = 'Halaman Tambah Data Master Barang';
        $breadcrumb = 'Master Barang';

        return view('barang.barang_add', compact('page_title', 'page_desc', 'breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
	        'kode_barang'   => 'required',
	        'nama_barang'	=> 'required',
	        'deskripsi'	    => 'required',
	    ];

	    $messages = [
	        'kode_barang.required'  => 'Kode Barang wajib diisi',
	        'nama_barang.required'	=> 'Nama Barang wajib diisi',
            'deskripsi.required'	=> 'Deskripsi wajib diisi',
	    ];

        $validator = Validator::make($request->all(), $rules, $messages);

	    if($validator->fails()) {
	        return redirect()->back()->withErrors($validator)->withInput($request->all);
	    }

        Barang::create($request->all());

        return redirect()->route('barang.index')->with('success', 'Data Barang berhasil disimpan !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        $page_title = 'Edit Data Master Barang';
        $page_desc  = 'Halaman Edit Data Master Barang';
        $breadcrumb = 'Master Barang';

        return view('barang.barang_edit', compact('page_title', 'page_desc', 'breadcrumb', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $rules = [
	        'kode_barang'   => 'required',
	        'nama_barang'	=> 'required',
	        'deskripsi'	    => 'required',
	    ];

	    $messages = [
	        'kode_barang.required'  => 'Kode Barang wajib diisi',
	        'nama_barang.required'	=> 'Nama Barang wajib diisi',
            'deskripsi.required'	=> 'Deskripsi wajib diisi',
	    ];

        $validator = Validator::make($request->all(), $rules, $messages);

	    if($validator->fails()) {
	        return redirect()->back()->withErrors($validator)->withInput($request->all);
	    }

        $barang->update($request->all());

        return redirect()->route('barang.index')->with('success', 'Data Barang berhasil diupdate !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Data Barang berhasil dihapus !!!');
    }
}
