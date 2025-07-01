<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $encryptedNpk = $request->input('encrypted_npk');
        $encryptedPassword = $request->input('encrypted_password');

        // Ambil private key
        $privateKeyPath = storage_path('app/keys/private.pem');
        $privateKeyString = file_get_contents($privateKeyPath);

        $privateKey = openssl_pkey_get_private($privateKeyString);

        if (!$privateKey) {
            Log::error('Private key tidak valid.');
            return redirect()->back()->with('error', 'Server error: kunci tidak valid.');
        }

        // Dekripsi NPK dan Password
        $decryptionNpk = openssl_private_decrypt(base64_decode($encryptedNpk), $decryptedNpk, $privateKey);
        $decryptionPassword = openssl_private_decrypt(base64_decode($encryptedPassword), $decryptedPassword, $privateKey);

        if (!$decryptionNpk || !$decryptionPassword) {
            return redirect()->back()->with('error', 'Gagal mendekripsi NPK atau Password.');
        }

        // Ambil user
        $user = User::where('npk', $decryptedNpk)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'NPK tidak ditemukan.');
        }

        if (!Hash::check($decryptedPassword, $user->password_hash)) {
            return redirect()->back()->with('error', 'Password salah.');
        }

        // Login
        Auth::login($user);

        return redirect()->route('admin.reports.index');
    }


    public function logout(Request $request)
    {
        Session::forget(['admin_logged_in', 'admin_id', 'admin_name']);
        return redirect()->route('admin.login');
    }

}
