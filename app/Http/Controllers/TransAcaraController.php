<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransAcaraController extends Controller
{
    public function index()
    {
        $acara = DB::table('acara')->get();
        $data = DB::table('trans_acara')->join('acara as x', 'trans_acara.acara_id', '=', 'x.id')->join('acara as y', 'trans_acara.acara_id', '=', 'y.id')->select('x.nama_acara', 'y.id', DB::raw('SUM(pemasukan) as totalPemasukan'), DB::raw('SUM(pengeluaran) as totalPengeluaran'))->groupBy('x.nama_acara', 'y.id')->get();
        return view('trans-acara.index', [
            'title' => 'Transaksi Acara',
            'breadcrumb' => 'Acara',
            'data' => $data,
            'acara' => $acara
        ]);
    }

    public function store(Request $request)
    {
        if($request->jenis_trans == 'pemasukan') {
            $pemasukan = $request->nominal;
            $pengeluaran = null;
        } else {
            $pengeluaran = $request->nominal;
            $pemasukan = null;
        }

        DB::table('trans_acara')->insert([
            'acara_id' => $request->acara_id,
            'tgl_trans' => $request->tgl_trans,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('trans-acara.show', $request->acara_id)->with('successInsert', 'Berhasil menambah transaksi');
    }

    public function update(Request $request, $id)
    {
        if($request->jenis_trans == 'pemasukan') {
            $pemasukan = $request->nominal;
            $pengeluaran = null;
        } else {
            $pengeluaran = $request->nominal;
            $pemasukan = null;
        }
        $data = array();
        $data['acara_id'] = $request->acara_id;
        $data['tgl_trans'] = $request->tgl_trans;
        $data['pemasukan'] = $pemasukan;
        $data['pengeluaran'] = $pengeluaran;
        $data['keterangan'] = $request->keterangan;
        DB::table('trans_acara')->where('id', '=', $id)->update($data);

        return redirect()->route('trans-acara.show', $request->acara_id)->with('successUpdate', 'Berhasil merubah transaksi');
    }

    public function show($id)
    {
        $acara = DB::table('acara')->get();
        $data = DB::table('trans_acara')->join('acara', 'trans_acara.acara_id', '=', 'acara.id')->select('trans_acara.*', 'acara.nama_acara')->where('trans_acara.acara_id', '=', $id)->get();
        return view('trans-acara.show', [
            'title' => 'Detail Transaksi',
            'breadcrumb' => 'Acara',
            'data' => $data,
            'acara' => $acara
        ]);
    }

    public function destroy($id)
    {
        $data = DB::table('trans_acara')->where('id', '=', $id)->first();
        if($data) {
            DB::table('trans_acara')->where('id', '=', $id)->delete();
            return redirect()->route('trans-acara.show', $data->acara_id)->with('successDelete', 'Berhasil menghapus transaksi');
        } else {
            return redirect()->route('trans-acara.index')->with('failedDelete', 'Gagal menghapus transaksi');
        }
    }
}
