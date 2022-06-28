<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $anggota = DB::table('jamaah')->orderBy('nama_jamaah')->get();
        $role = DB::table('role')->orderBy('nama_role')->get();
        $data = DB::table('users')->join('jamaah', 'users.user_id', '=', 'jamaah.id')->join('role', 'users.role_id', 'role.id')->select('users.*', 'jamaah.nama_jamaah', 'role.nama_role')->orderBy('jamaah.nama_jamaah')->get();
        return view('users.index', [
            'title' => 'User',
            'breadcrumb' => 'Master Data',
            'anggota' => $anggota,
            'role' => $role,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $cekUser = DB::table('users')->join('jamaah', 'users.user_id', '=', 'jamaah.id')->select('users.*', 'jamaah.nama_jamaah')->where('user_id', '=', $request->user_id)->first();
        $cekUsername = DB::table('users')->where('username', '=', $request->username)->first();
        $cekRole = DB::table('users')->join('role', 'users.role_id', '=', 'role.id')->select('users.*', 'role.nama_role')->where('role_id', '=', $request->role_id)->first();
        
        if($cekUser) {
            return redirect()->route('users.index')->with('duplicateData', 'Anggota "' . $cekUser->nama_jamaah . '" sudah terdaftar !');
        } elseif($cekUsername) {
            return redirect()->route('users.index')->with('duplicateData', 'Maaf, username "' . $cekUsername->username . '" sudah digunakan. Silahkan gunakan username lain !');
        } elseif($cekRole) {
            return redirect()->route('users.index')->with('duplicateData', 'Maaf, role "' . $cekRole->nama_role . '" sudah digunakan. Silahkan pilih role lain !');
        } else {
            DB::table('users')->insert([
                'user_id' => $request->user_id,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
                'active' => $request->active
            ]);
            return redirect()->route('users.index')->with('successInsert', 'Berhasil menambahkan User "' . $request->username . '"');
        }

    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['user_id'] = $request->user_id;
        $data['username'] = $request->username;
        $data['password'] = $request->password;
        $data['role_id'] = $request->role_id;
        $data['active'] = $request->active;
        DB::table('users')->where('id', '=', $id)->update($data);
        
        if($request->active == 0) {
            return redirect()->route('users.index')->with('successUpdate', 'Berhasil menonaktifkan User "' . $request->username . '"');
        } else {
            return redirect()->route('users.index')->with('successUpdate', 'Berhasil mengaktifkan User "' . $request->username . '"');
        }
    }

    public function destroy($id)
    {
       $data = DB::table('users')->where('users.id', '=', $id)->join('jamaah', 'users.user_id', '=', 'jamaah.id')->join('role', 'users.role_id', 'role.id')->select('users.*', 'jamaah.nama_jamaah', 'role.nama_role')->first();
       if($data) {
        DB::table('users')->where('id', '=', $id)->delete();
        return redirect()->route('users.index')->with('successDelete', 'Berhasil menghapus data User "' . $data->nama_jamaah . '"');
    } else {
           return redirect()->route('users.index')->with('failedDelete', 'Gagal menghapus data User !');
       }

    }
}
