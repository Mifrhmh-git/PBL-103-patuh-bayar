<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class Layout extends Controller
{
    /**
     * Menampilkan halaman utama (home).
     *
     * @return \Illuminate\View\View Tampilan halaman home.
     */
    public function home()
    {
        return view('layout.home', ['title' => 'Dashboard']);
    }

    /**
     * Logout pengguna dan redirect ke halaman utama.
     *
     * @param Request $request Objek permintaan HTTP.
     * @return \Illuminate\Http\RedirectResponse Redirect ke halaman utama setelah logout.
     */
    public function logout(Request $request)
    {
        // Logout pengguna
        Auth::logout();

        // Redirect ke halaman utama
        return redirect('/');
    }
}
