<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StrukturDKMController extends Controller
{
    public function index()
    {
        $jamaah = DB::table('jamaah')->get();
        $data = DB::table('struktur_dkm')->join('jamaah', 'struktur_dkm.pengurus_id', '=', 'jamaah.id')->select('struktur_dkm.*', 'jamaah.nama_jamaah')->get();
        return view('struktur-dkm.index', [
            'title' => 'Data Anggota DKM',
            'breadcrumb' => 'Profil Masjid',
            'jamaah' => $jamaah,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $cekJabatan = DB::table('struktur_dkm')->where('jabatan', '=', $request->jabatan)->first();
        $cekPeriode = DB::table('struktur_dkm')->where('periode_mulai', '=', $request->periode_mulai)->first();
        
        if ($cekJabatan == null && $cekPeriode == null || $cekJabatan !== null && $cekPeriode == null || $cekJabatan == null && $cekPeriode !== null) {
            DB::table('struktur_dkm')->insert([
                'pengurus_id' => $request->pengurus_id,
                'jabatan' => $request->jabatan,
                'tupoksi' => $request->tupoksi,
                'periode_mulai' => $request->periode_mulai,
                'periode_selesai' => $request->periode_selesai
            ]);
        } elseif ($request->jabatan == $cekJabatan->jabatan && $request->periode_mulai == $cekPeriode->periode_mulai) {
            return redirect()->route('struktur-dkm.index')->with('duplicateData', 'Jabatan "' . $request->jabatan . '" di periode "'. date('d M Y', strtotime($request->periode_mulai)) .'" sudah ada. Silahkan masukkan jabatan dengan periode lain !');
        }
        $pengurus = DB::table('struktur_dkm')->join('jamaah', 'struktur_dkm.pengurus_id', '=', 'jamaah.id')->select('struktur_dkm.*', 'jamaah.nama_jamaah')->where('struktur_dkm.pengurus_id' ,'=', $request->pengurus_id)->first();
        return redirect()->route('struktur-dkm.index')->with('successInsert', 'Berhasil menambahkan Jamaah "' . $pengurus->nama_jamaah . '"');
    }

    public function update(Request $request, $id)
    {
        $pengurus = DB::table('struktur_dkm')->join('jamaah', 'struktur_dkm.pengurus_id', '=', 'jamaah.id')->select('jamaah.nama_jamaah')->where('struktur_dkm.id' ,'=', $id)->first();
        $data = array();
        $data['pengurus_id'] = $request->pengurus_id;
        $data['jabatan'] = $request->jabatan;
        $data['tupoksi'] = $request->tupoksi;
        $data['periode_mulai'] = $request->periode_mulai;
        $data['periode_selesai'] = $request->periode_selesai;

        DB::table('struktur_dkm')->where('id', '=', $id)->update($data);

        return redirect()->route('struktur-dkm.index')->with('successUpdate', 'Berhasil mengubah data "' . $pengurus->nama_jamaah . '"');
    }

    public function destroy($id)
    {
        $data = DB::table('struktur_dkm')->join('jamaah', 'struktur_dkm.pengurus_id', '=', 'jamaah.id')->select('jamaah.nama_jamaah')->where('struktur_dkm.id', '=', $id)->first();
        if($data) {
            DB::table('struktur_dkm')->where('id', '=', $id)->delete();
            return redirect()->route('struktur-dkm.index')->with('successDelete', 'Berhasil menghapus data "' . $data->nama_jamaah . '"');
        } else {
            return redirect()->route('struktur-dkm.index')->with('successDelete', 'Berhasil menghapus data Anggota DKM !');
        }

    }
}