<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'npk' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari user berdasarkan NPK
        $user = User::where('npk', $request->npk)->first();

        // Validasi user dan password
        if (!$user || !Hash::check($request->password, $user->password_hash)) {
            return back()->with('error', 'NPK atau password salah');
        }

        // Cek apakah user ini termasuk admin dari tabel admin_whistleblowing
        $isAdmin = DB::table('admin_whistleblowing')->where('user_id', $user->id)->exists();

        if (!$isAdmin) {
            return back()->with('error', 'Anda tidak memiliki akses sebagai admin');
        }

        // Simpan session login admin
        Session::put('admin_logged_in', true);
        Session::put('admin_id', $user->id);
        Session::put('admin_name', $user->name);

        return redirect()->route('admin.reports.index');
    }

    public function logout(Request $request)
    {
        Session::forget(['admin_logged_in', 'admin_id', 'admin_name']);
        return redirect()->route('admin.login');
    }

}
