<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $userLogin = DB::table('users')->join('jamaah', 'users.user_id', '=', 'jamaah.id')->join('role', 'users.role_id', '=', 'role.id')->select('users.*', 'jamaah.nama_jamaah', 'jamaah.foto_jamaah', 'role.nama_role')->where('username', '=', $request->username)->first();

        if($userLogin && Hash::check($request->password, $userLogin->password) && $userLogin->active == 1) {
            $request->session()->put('dataUser', $userLogin);
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login.index')->with('loginFailed', 'Username atau password salah !');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login.index');
    }
}
