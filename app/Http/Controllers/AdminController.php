<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Logout pengguna dan mengatur ulang sesi.
     *
     * @param Request $request Objek permintaan HTTP.
     * @return \Illuminate\Http\RedirectResponse Redirect ke halaman login.
     */
    public function logout(Request $request)
    {
        // Logout pengguna
        Auth::logout();

        // Hapus semua data sesi untuk keamanan
        $request->session()->invalidate();

        // Regenerasi token sesi untuk mencegah CSRF
        $request->session()->regenerateToken();

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('loginpanel')->with('success', 'Anda telah logout');
    }
}
