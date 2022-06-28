<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SejarahMasjidController extends Controller
{
    public function index()
    {
        $data = DB::table('sejarah_masjid')->first();
        return view('sejarah-masjid.index', [
            'title' => 'Sejarah Masjid',
            'breadcrumb' => 'Profil Masjid',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        DB::table('sejarah_masjid')->insert([
            'foto_masjid' => $request->file('foto_masjid')->store('foto_masjid'),
            'nama_masjid' => $request->nama_masjid,
            'alamat_masjid' => $request->alamat_masjid,
            'call_center' => $request->call_center,
            'luas_tanah' => $request->luas_tanah,
            'luas_bangunan' => $request->luas_bangunan,
            'tahun_berdiri' => $request->tahun_berdiri,
            'legalitas' => $request->legalitas,
            'keterangan_sejarah' => $request->keterangan_sejarah,
        ]);

        return redirect()->route('sejarah-masjid.index');
    }

    public function update(Request $request, $id)
    {
        $foto_masjid_lama = DB::table('sejarah_masjid')->where('id', '=', $id)->get();
        if($request->foto_masjid == null) {
            $fotoMasjid = $foto_masjid_lama[0]->foto_masjid;
        } else {
            $fotoMasjid = $request->file('foto_masjid')->store('foto_masjid');
        }
        $data = array();
        $data['foto_masjid'] = $fotoMasjid;
        $data['nama_masjid'] = $request->nama_masjid;
        $data['alamat_masjid'] = $request->alamat_masjid;
        $data['call_center'] = $request->call_center;
        $data['luas_tanah'] = $request->luas_tanah;
        $data['luas_bangunan'] = $request->luas_bangunan;
        $data['tahun_berdiri'] = $request->tahun_berdiri;
        $data['legalitas'] = $request->legalitas;
        $data['keterangan_sejarah'] = $request->keterangan_sejarah;
        DB::table('sejarah_masjid')->where('id', '=', $id)->update($data);

        return redirect()->route('sejarah-masjid.index')->with('successUpdate', 'Berhasil merubah sejarah Masjid');
    }
}
