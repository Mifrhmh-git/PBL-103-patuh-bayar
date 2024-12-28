<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Mengimpor class Request untuk menangani data yang dikirim melalui form
use Illuminate\Support\Facades\Auth; // Mengimpor Auth untuk mengambil data user yang sedang login
use Illuminate\Support\Facades\Hash; // Mengimpor Hash untuk mengenkripsi password
use Illuminate\Support\Facades\Storage; // Mengimpor Storage untuk mengelola file yang diunggah

class ProfilController extends Controller
{
    // Method untuk menampilkan halaman profil
    public function index()
    {
        return view('profil', ['title' => 'Profil']); // Mengembalikan view 'profil' dengan data 'title' untuk digunakan di halaman
    }

    // Method untuk memperbarui data profil pengguna
    public function update(Request $request)
    {
        $user = Auth::user(); // Mendapatkan data user yang sedang login

        // Memperbarui nama dan email user sesuai data dari form
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika field password diisi, maka password akan diupdate
        if ($request->password) {
            $user->password = Hash::make($request->password); // Mengenkripsi password sebelum disimpan ke database
            $user->pw = $request->password; // Menyimpan password asli (praktik ini kurang aman, sebaiknya dihapus)
        }

        $user->save(); // Menyimpan perubahan data user ke database

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.'); // Mengembalikan user ke halaman sebelumnya dengan pesan sukses
    }

    // Method untuk memperbarui foto profil pengguna
    public function updateImage(Request $request)
    {
        // Validasi input file gambar (wajib, format tertentu, dan ukuran maksimum 2MB)
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user(); // Mendapatkan data user yang sedang login

        // Jika user sudah memiliki foto profil sebelumnya, maka file tersebut akan dihapus
        if ($user->image) {
            Storage::delete($user->image);
        }

        // Menyimpan file gambar yang diunggah ke folder 'profiles' di penyimpanan publik
        $path = $request->file('image')->store('profiles', 'public');
        $user->image = $path; // Menyimpan path gambar di database
        $user->save(); // Menyimpan perubahan data user ke database

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.'); // Mengembalikan user ke halaman sebelumnya dengan pesan sukses
    }
}
