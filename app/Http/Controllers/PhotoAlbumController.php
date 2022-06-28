<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotoAlbumController extends Controller
{
    public function store(Request $request)
    {
        DB::table('photo_album')->insert([
            'album_id' => $request->album_id,
            'nama_foto' => $request->nama_foto,
            'foto_album' => $request->file('foto_album')->store('photos'),
            'deskripsi_foto' => $request->deskripsi_foto,
        ]);
        return redirect()->route('photo-album.show', $request->album_id)->with('successInsert', 'Berhasil menambahkan foto "' . $request->nama_foto . '"');
    }

    public function show($id)
    {
        $data = DB::table('photo_album')->join('albums', 'photo_album.album_id', '=', 'albums.id')->select('photo_album.*', 'albums.nama_album')->where('photo_album.album_id', '=', $id)->get();
        return view('album.show', [
            'title' => 'Photo Album',
            'breadcrumb' => 'Galeri',
            'data' => $data,
            'album_id' => $id
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['album_id'] = $request->album_id;
        $data['nama_foto'] = $request->nama_foto;
        if($request->foto_album == null) {
            $data['foto_album'] = $request->foto_album_lama;
        } else {
            $data['foto_album'] = $request->file('foto_album')->store('photos');
        }
        $data['deskripsi_foto'] = $request->deskripsi_foto;
        DB::table('photo_album')->where('id', '=', $id)->update($data);
        return redirect()->route('photo-album.show', $request->album_id)->with('successUpdate', 'Berhasil merubah foto "' . $request->nama_foto . '"');
    }

    public function destroy($id)
    {
        $data = DB::table('photo_album')->where('id', '=', $id)->first();

        if($data) {
            DB::table('photo_album')->where('id', '=', $id)->delete();
            return redirect()->route('photo-album.show', $data->album_id)->with('successDelete', 'Berhasil menghapus foto "' . $data->nama_foto . '"');
        }
    }
}