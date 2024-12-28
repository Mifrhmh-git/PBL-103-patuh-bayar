<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Mengimpor class Request untuk menangani input dari form
use App\Mail\sendEmail; // Mengimpor class untuk template email yang digunakan
use Illuminate\Support\Facades\Mail; // Mengimpor Mail untuk mengirim email
use App\Models\Warga; // Mengimpor model Warga untuk mengambil data dari tabel warga

class sendEmailController extends Controller
{
    /**
     * Menampilkan tampilan form pengiriman email.
     *
     * @return \Illuminate\View\View Tampilan form pengiriman email.
     */
    public function index()
    {
        // Mengembalikan tampilan form email ke pengguna
        return view('email.email');
    }

    /**
     * Mengirimkan email pengingat ke semua warga.
     *
     * @return \Illuminate\Http\RedirectResponse Redirect dengan pesan hasil pengiriman.
     */
    public function send_email()
    {
        // Mengambil semua data warga dari tabel warga
        $wargas = Warga::all();

        // Mengecek apakah data warga kosong
        if ($wargas->isEmpty()) {
            // Jika tidak ada data warga, kembali ke halaman email dengan pesan error
            return redirect()->route('email')->with('pesan', 'Tidak ada data warga');
        }

        // Melakukan iterasi untuk setiap warga
        foreach ($wargas as $warga) {
            // Menyiapkan data yang akan dimasukkan dalam email
            $data = [
                'text' => 'Pengingat : Tenggat pembayaran Anda adalah tanggal 20. Segera lakukan pembayaran untuk menghindari denda keterlambatan, hiraukan jika Anda telah membayar. Terima kasih.',
            ];

            // Mengirim email ke alamat email yang terdaftar di data warga
            Mail::to($warga->email)->send(new sendEmail($data));
        }

        // Setelah selesai mengirim email, redirect ke halaman email dengan pesan sukses
        return redirect()->route('email')->with('pesan', 'Email berhasil terkirim ke semua warga');
    }
}
