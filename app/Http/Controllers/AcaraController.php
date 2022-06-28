<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AcaraController extends Controller
{
    public function index()
    {
        $jamaah = DB::table('jamaah')->get();
        $data = DB::table('acara')->leftjoin('jamaah as ketua', 'acara.ketua_panitia', '=', 'ketua.id')->leftjoin('jamaah as wakil', 'acara.wakil_ketua_panitia', '=', 'wakil.id')->leftjoin('jamaah as sekretaris', 'acara.sekretaris_acara', '=', 'sekretaris.id')->leftjoin('jamaah as bendahara', 'acara.bendahara_acara', '=', 'bendahara.id')->leftjoin('jamaah as koor_acara', 'acara.koordinator_acara', '=', 'koor_acara.id')->leftjoin('jamaah as koor_konsumsi', 'acara.koordinator_konsumsi', '=', 'koor_konsumsi.id')->leftjoin('jamaah as koor_dokumentasi', 'acara.koordinator_dokumentasi', '=', 'koor_dokumentasi.id')->leftjoin('jamaah as koor_keamanan', 'acara.koordinator_keamanan', '=', 'koor_keamanan.id')->leftjoin('jamaah as koor_peralatan', 'acara.koordinator_peralatan', '=', 'koor_peralatan.id')->leftjoin('jamaah as penanggungjawab', 'acara.penanggungjawab_acara', '=', 'penanggungjawab.id')->leftjoin('jamaah as penasehat', 'acara.penasehat_acara', '=', 'penasehat.id')->select('acara.*', 'ketua.nama_jamaah as ketua', 'wakil.nama_jamaah as wakil', 'sekretaris.nama_jamaah as sekretaris', 'bendahara.nama_jamaah as bendahara', 'koor_acara.nama_jamaah as koor_acara', 'koor_konsumsi.nama_jamaah as koor_konsumsi', 'koor_dokumentasi.nama_jamaah as koor_dokumentasi', 'koor_keamanan.nama_jamaah as koor_keamanan', 'koor_peralatan.nama_jamaah as koor_peralatan', 'penanggungjawab.nama_jamaah as penanggungjawab', 'penasehat.nama_jamaah as penasehat')->get();
        return view('acara.index', [
            'title' => 'To do list',
            'breadcrumb' => 'Acara',
            'data' => $data,
            'jamaah' => $jamaah
        ]);
    }

    public function store(Request $request)
    {
        DB::table('acara')->insert([
            'nama_acara' => $request->nama_acara,
            'tgl_mulai_acara' => $request->tgl_mulai_acara,
            'tgl_selesai_acara' => $request->tgl_selesai_acara,
            'anggaran_dana' => $request->anggaran_dana,
            'ketua_panitia' => $request->ketua_panitia,
            'wakil_ketua_panitia' => $request->wakil_ketua_panitia,
            'sekretaris_acara' => $request->sekretaris_acara,
            'bendahara_acara' => $request->bendahara_acara,
            'koordinator_acara' => $request->koordinator_acara,
            'koordinator_konsumsi' => $request->koordinator_konsumsi,
            'koordinator_dokumentasi' => $request->koordinator_dokumentasi,
            'koordinator_keamanan' => $request->koordinator_keamanan,
            'koordinator_peralatan' => $request->koordinator_peralatan,
            'penanggungjawab_acara' => $request->penanggungjawab_acara,
            'penasehat_acara' => $request->penasehat_acara,
            'keterangan' => $request->keterangan
        ]);
        return redirect()->route('acara.index')->with('successInsert', 'Berhasil menambahkan acara "' . $request->nama_acara . '"');
    }

    public function update(Request $request, $id)
    {
        
        $data = array();
        $data['nama_acara'] = $request->nama_acara;
        $data['tgl_mulai_acara'] = $request->tgl_mulai_acara;
        $data['tgl_selesai_acara'] = $request->tgl_selesai_acara;
        $data['anggaran_dana'] = $request->anggaran_dana;
        $data['ketua_panitia'] = $request->ketua_panitia;
        $data['wakil_ketua_panitia'] = $request->wakil_ketua_panitia;
        $data['sekretaris_acara'] = $request->sekretaris_acara;
        $data['bendahara_acara'] = $request->bendahara_acara;
        $data['koordinator_acara'] = $request->koordinator_acara;
        $data['koordinator_konsumsi'] = $request->koordinator_konsumsi;
        $data['koordinator_dokumentasi'] = $request->koordinator_dokumentasi;
        $data['koordinator_keamanan'] = $request->koordinator_keamanan;
        $data['koordinator_peralatan'] = $request->koordinator_peralatan;
        $data['penanggungjawab_acara'] = $request->penanggungjawab_acara;
        $data['penasehat_acara'] = $request->penasehat_acara;
        if($request->keterangan == null) {
            $data['keterangan'] = $request->keterangan_lama;
        } else {
            $data['keterangan'] = $request->keterangan;
        }
        DB::table('acara')->where('id', '=', $id)->update($data);
        
        $acara = DB::table('acara')->where('id', '=', $id)->first();
        return redirect()->route('acara.index')->with('successUpdate', 'Berhasil merubah acara "' . $acara->nama_acara . '"');
    }

    public function destroy($id)
    {
        $data = DB::table('acara')->where('id', '=', $id)->first();
        if($data) {
            DB::table('acara')->where('id', '=', $id)->delete();
            return redirect()->route('acara.index')->with('successDelete', 'Berhasil menghapus acara "' . $data->nama_acara . '"');
        } else {
            return redirect()->route('acara.index')->with('successDelete', 'Gagal menghapus acara !');
        }
    }
}
