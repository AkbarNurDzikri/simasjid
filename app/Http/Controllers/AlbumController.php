<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlbumController extends Controller
{
    public function index()
    {
        $data = DB::table('albums')->get();
        return view('album.index', [
            'title' => 'Album Kategori',
            'breadcrumb' => 'Galeri',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $cekNamaAlbum = DB::table('albums')->where('nama_album', '=', $request->nama_album)->first();

        if($cekNamaAlbum) {
            if($cekNamaAlbum->nama_album == $request->nama_album) {
                return redirect()->route('album.index')->with('duplicateData', 'Maaf, nama album sudah terdaftar. Silahkan buat nama album selain "' . $request->nama_album . '" !');
            }
        } else {
                DB::table('albums')->insert([
                    'nama_album' => $request->nama_album,
                    'cover_album' => $request->file('cover_album')->store('album-photo')
                ]);

                return redirect()->route('album.index')->with('successInsert', 'Berhasil menambahkan album "' . $request->nama_album . '"');
            }
    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['nama_album'] = $request->nama_album;
        if($request->cover_album == null) {
            $data['cover_album'] = $request->cover_album_lama;
        } else {
            $data['cover_album'] = $request->file('cover_album')->store('album-photo');
        }
        DB::table('albums')->where('id', '=' , $id)->update($data);

        return redirect()->route('album.index')->with('successInsert', 'Berhasil merubah album "' . $request->nama_album . '"');
    }

    public function destroy($id)
    {
        $data = DB::table('albums')->where('id', '=', $id)->first();
        $cekIsiAlbum = DB::table('photo_album')->where('album_id', '=', $id)->first();
        if($cekIsiAlbum) {
            if($cekIsiAlbum !== null) {
                return redirect()->route('album.index')->with('failedDelete', 'Album berisi foto tidak bisa dihapus !');
            }
         } elseif($data) {
                DB::table('albums')->where('id', '=', $id)->delete();
                return redirect()->route('album.index')->with('successDelete', 'Berhasil menghapus album "' . $data->nama_album . '"');
            } else {
                return redirect()->route('album.index')->with('failedDelete', 'Gagal menghapus data');
            }
    }
}
