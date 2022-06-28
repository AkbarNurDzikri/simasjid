<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JamaahController extends Controller
{
    public function index()
    {
        $data = DB::table('jamaah')->orderBy('nama_jamaah', 'asc')->get();
        return view('jamaah.index',[
            'title' => "Data Jama'ah",
            'breadcrumb' => 'Master Data',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        DB::table('jamaah')->insert([
            'nama_jamaah' => $request->nama_jamaah,
            'no_ktp' => $request->no_ktp,
            'no_kk' => $request->no_kk,
            'alamat_jamaah' => $request->alamat_jamaah,
            'no_hp' => $request->no_hp,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jenkel' => $request->jenkel,
            'status_nikah' => $request->status_nikah,
            'agama' => $request->agama,
            'gol_darah' => $request->gol_darah,
            'pekerjaan' => $request->pekerjaan,
            'status_ekonomi' => $request->status_ekonomi,
            'status_jamaah' => $request->status_jamaah,
            'foto_jamaah' => $request->file('foto_jamaah')->store('foto-jamaah')
        ]);

        return redirect()->route('jamaah.index')->with('successInsert', "Berhasil menambahkan Jam'ah " . '"' .$request->nama_jamaah . '"');
    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['nama_jamaah'] = $request->nama_jamaah;
        $data['no_ktp'] = $request->no_ktp;
        $data['no_kk'] = $request->no_kk;
        $data['alamat_jamaah'] = $request->alamat_jamaah;
        $data['no_hp'] = $request->no_hp;
        $data['tempat_lahir'] = $request->tempat_lahir;
        $data['tgl_lahir'] = $request->tgl_lahir;
        $data['jenkel'] = $request->jenkel;
        $data['status_nikah'] = $request->status_nikah;
        $data['agama'] = $request->agama;
        $data['gol_darah'] = $request->gol_darah;
        $data['pekerjaan'] = $request->pekerjaan;
        $data['status_ekonomi'] = $request->status_ekonomi;
        $data['status_jamaah'] = $request->status_jamaah;
        if  ($request->foto_jamaah == null) {
            $data['foto_jamaah'] = $request->foto_jamaah_lama;
        } else {
            $data['foto_jamaah'] = $request->file('foto_jamaah')->store('foto-jamaah');
        }
        DB::table('jamaah')->where('id', '=', $id)->update($data);

        return redirect()->route('jamaah.index')->with('successUpdate', "Berhasil mengubah data Jama'ah " . '"' . $request->nama_jamaah . '"');
    }

    public function destroy($id)
    {
        $data = DB::table('jamaah')->where('id', '=', $id)->first();
        $userTerdaftar = DB::table('users')->where('user_id', '=', $id)->first();
        $anggotaDKM = DB::table('struktur_dkm')->where('pengurus_id', '=', $id)->first();
        if($userTerdaftar) {
            if($userTerdaftar !== null) {
                return redirect()->route('jamaah.index')->with('failedDelete', '"' . $data->nama_jamaah . '"' . " terdaftar di akun login, data Jama'ah tidak bisa dihapus !");
            }
         } elseif($anggotaDKM) {
            if($anggotaDKM !== null) {
                return redirect()->route('jamaah.index')->with('failedDelete', '"' . $data->nama_jamaah . '"' . " terdaftar di struktur DKM, data Jama'ah tidak bisa dihapus !");
            }
         } elseif($data) {
                DB::table('jamaah')->where('id', '=', $id)->delete();
                return redirect()->route('jamaah.index')->with('successDelete', "Berhasil menghapus data Jama'ah " . '"' . $data->nama_jamaah . '"');
            } else {
                return redirect()->route('jamaah.index')->with('failedDelete', "Gagal menghapus data jama'ah !");
            }

    }
}
