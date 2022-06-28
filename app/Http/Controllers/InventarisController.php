<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventarisController extends Controller
{
    public function index()
    {
        $data = DB::table('inventaris')->get();
        return view('inventaris.index', [
            'title' => 'Barang',
            'breadcrumb' => 'Inventaris',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        DB::table('inventaris')->insert([
            'nama_barang' => $request->nama_barang,
            'satuan' => $request->satuan,
            'lokasi_penyimpanan' => $request->lokasi_penyimpanan
        ]);

        return redirect()->route('inventaris.index')->with('successInsert', 'Berhasil menambahkan "' . $request->nama_barang . '"');
    }

    public function update (Request $request, $id)
    {
        $data = DB::table('inventaris')->where('id', '=', $id)->first();

        $data = array();
        $data['nama_barang'] = $request->nama_barang;
        $data['satuan'] = $request->satuan;
        $data['lokasi_penyimpanan'] = $request->lokasi_penyimpanan;
        DB::table('inventaris')->where('id', '=', $id)->update($data);

        return redirect()->route('inventaris.index')->with('successUpdate', 'Berhasil merubah "' . $request->nama_barang . '"');
    }

    public function destroy($id)
    {
        $data = DB::table('inventaris')->where('id', '=', $id)->first();

        if($data) {
            DB::table('inventaris')->where('id', '=', $id)->delete();
            return redirect()->route('inventaris.index')->with('successDelete', 'Berhasil merubah "' . $data->nama_barang . '"');
        } else {
            return redirect()->route('inventaris.index')->with('failedUpdate', 'Gagal merubah barang !');
        }
    }
}
