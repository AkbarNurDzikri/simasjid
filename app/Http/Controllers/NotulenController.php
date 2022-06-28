<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotulenController extends Controller
{
    public function index()
    {
        $data = DB::table('notulen')->get();
        return view('notulen.index', [
            'title' => 'To do list',
            'breadcrumb' => 'Notulen',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        DB::table('notulen')->insert([
            'tgl_rapat' => $request->tgl_rapat,
            'judul_notulen' => $request->judul_notulen,
            'isi_notulen' => $request->isi_notulen
        ]);
        return redirect()->route('notulen.index')->with('successInsert', 'Berhasil menambahkan notulen "' . $request->judul_notulen . '"');
    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['judul_notulen'] = $request->judul_notulen;
        if($request->isi_notulen == null) {
            $data['isi_notulen'] = $request->isi_notulen_lama;
        } else {
            $data['isi_notulen'] = $request->isi_notulen;
        }
        $data['tgl_rapat'] = $request->tgl_rapat;
        DB::table('notulen')->where('id', '=' ,$id)->update($data);

        return redirect()->route('notulen.index')->with('successInsert', 'Berhasil merubah notulen "' . $request->judul_notulen . '"');
    }

    public function destroy($id)
    {
        $data = DB::table('notulen')->where('id', '=', $id)->first();
        if($data) {
            DB::table('notulen')->where('id', '=', $id)->delete();
            return redirect()->route('notulen.index')->with('successDelete', 'Berhasil menghapus notulen "' . $data->judul_notulen . '"');
        } else {
            return redirect()->route('notulen.index')->with('failedDelete', 'Gagal menghapus notulen !');
        }
    }
}