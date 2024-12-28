<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman dashboard.
     *
     * @param Request $request Objek permintaan HTTP.
     * @return \Illuminate\View\View Halaman dashboard dengan data yang diperlukan.
     */
    public function index(Request $request)
    {
        // Mengambil parameter 'tahun' dari permintaan
        $tahun = $request->get('tahun');

        // Mengembalikan tampilan 'dashboard' dengan data 'tahun' dan 'title'
        return view('dashboard', compact('tahun'))->with(['title' => 'Patuh Bayar']);
    }
}
