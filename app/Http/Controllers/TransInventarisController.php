<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransInventarisController extends Controller
{
    public function index()
    {
        $data = DB::table('trans_inventaris')->join('inventaris as x', 'trans_inventaris.inventaris_id', '=', 'x.id')->join('inventaris as y', 'trans_inventaris.inventaris_id', '=', 'y.id')->select('x.nama_barang', 'y.id', DB::raw('SUM(barang_masuk) as totalBarangMasuk'), DB::raw('SUM(barang_keluar) as totalBarangKeluar'))->groupBy('x.nama_barang', 'y.id')->get();
        return view('trans-inventaris.index', [
            'title' => 'Transaksi Keluar Masuk Barang',
            'breadcrumb' => 'Inventaris',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        if($request->jenis_trans == 'barang_masuk') {
                $barang_masuk = $request->qty;
                $barang_keluar = null;
            } else {
                $barang_keluar = $request->qty;
                $barang_masuk = null;
            }
            DB::table('trans_inventaris')->insert([
            'tgl_trans' => $request->tgl_trans,
            'inventaris_id' => $request->inventaris_id,
            'barang_masuk' => $barang_masuk,
            'barang_keluar' => $barang_keluar,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('trans-inv.index')->with('successInsert', 'Berhasil membuat transaksi');
    }

    public function update(Request $request, $id)
    {
        if($request->jenis_trans == 'barang_masuk') {
                $barang_masuk = $request->qty;
                $barang_keluar = null;
            } else {
                $barang_keluar = $request->qty;
                $barang_masuk = null;
            }
            $data = array();
            $data['tgl_trans'] = $request->tgl_trans;
            $data['inventaris_id'] = $request->inventaris_id;
            $data['barang_masuk'] = $barang_masuk;
            $data['barang_keluar'] = $barang_keluar;
            $data['keterangan'] = $request->keterangan;
            DB::table('trans_inventaris')->where('id', '=', $id)->update($data);

        return redirect()->route('trans-inv.show', $request->inventaris_id)->with('successUpdate', 'Berhasil merubah transaksi');
    }

    public function show($id)
    {
        $barang = DB::table('inventaris')->get();
        $data = DB::table('trans_inventaris')->join('inventaris', 'trans_inventaris.inventaris_id', '=', 'inventaris.id')->select('trans_inventaris.*', 'inventaris.nama_barang')->where('.trans_inventaris.inventaris_id', '=', $id)->get();
        return view('trans-inventaris.show', [
            'title' => 'Daftar Transaksi',
            'breadcrumb' => 'Transaksi Inventaris',
            'data' => $data,
            'barang' => $barang
        ]);
    }

    public function destroy($id)
    {
        $data = DB::table('trans_inventaris')->where('id', '=', $id)->first();
        DB::table('trans_inventaris')->where('id', '=', $id)->delete();
        return redirect()->route('trans-inv.show', $data->inventaris_id)->with('successDelete', 'Berhasil menghapus transaksi');
    }
}
