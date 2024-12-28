<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login.
     *
     * @return \Illuminate\View\View Tampilan halaman login.
     */
    public function index()
    {
        // Mengembalikan tampilan loginpanel dengan judul 'Login'
        return view('loginpanel', ['title' => 'Login']);
    }

    /**
     * Mengecek kredensial login dan autentikasi pengguna.
     *
     * @param Request $request Objek permintaan HTTP.
     * @return \Illuminate\Http\RedirectResponse Redirect sesuai hasil autentikasi.
     */
    public function ceklogin(Request $request)
    {
        // Validasi input email dan password
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi'
        ]);

        // Menyiapkan data untuk autentikasi
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // Mengecek kredensial menggunakan Auth
        if (Auth::attempt($credentials)) {
            // Redirect ke halaman home setelah login berhasil
            return redirect('/layout/home')->with('success', 'Berhasil login');
        } else {
            // Mengembalikan error jika kredensial salah
            return redirect('loginpanel')->withErrors('Username dan password yang dimasukkan SALAH');
        }
    }
}
