<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $data = DB::table('role')->get();
        return view('role.index', [
            'title' => 'Role',
            'breadcrumb' => 'Master Data',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        DB::table('role')->insert(['nama_role' => $request->nama_role]);

        return redirect()->route('role.index')->with('successInsert', 'Berhasil menambahkan role "' . $request->nama_role . '"');
    }

    public function update(Request $request, $id)
    {
        $data['nama_role'] = $request->nama_role;
        DB::table('role')->where('id', '=', $id)->update($data);

        return redirect()->route('role.index')->with('successUpdate', 'Berhasil merubah role "' . $request->nama_role . '"');
    }
    
    public function destroy($id)
    {
        $data = DB::table('role')->where('id', '=', $id)->first();
        $roleTerdaftar = DB::table('users')->where('role_id' ,'=', $id)->first();
        if($roleTerdaftar) {
            if($roleTerdaftar !== null) {
                return redirect()->route('role.index')->with('failedDelete', 'Role "' . $data->nama_role . '" sudah dipakai user, tidak bisa dihapus !');
            }
        } elseif($data) {
            DB::table('role')->where('id', '=', $id)->delete();
            return redirect()->route('role.index')->with('successDelete', 'Berhasil menghapus role "' . $data->nama_role . '"');
        } else {
            return redirect()->route('role.index')->with('failedDelete', 'Gagal menghapus role !');
        }

    }
}
