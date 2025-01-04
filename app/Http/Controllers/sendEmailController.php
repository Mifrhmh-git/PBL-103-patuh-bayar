<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\sendEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Warga;

class sendEmailController extends Controller
{
    /**
     * Menampilkan tampilan form pengiriman email.
     */
    public function index()
    {
        return view('email.email');
    }

    /**
     * Menghapus data pembayaran.
     *
     * @param string $id_bayar ID pembayaran.
     * @return \Illuminate\Http\RedirectResponse Redirect ke halaman data pembayaran.
     */
    public function send_email()
    {
        $wargas = Warga::all();

        if ($wargas->isEmpty()) {
            return redirect()->route('email')->with('pesan', 'Tidak ada data warga yang ditemukan.');
        }

        foreach ($wargas as $warga) {
            $data = [
                'text' => 'Pengingat: Tenggat pembayaran Anda adalah tanggal 20. Segera lakukan pembayaran untuk menghindari denda keterlambatan. Terima kasih.',
            ];
            Mail::to($warga->email)->send(new sendEmail($data));
        }

        return redirect()->route('Pembayarans.index')->with(['success' => 'Email berhasil terkirim ke semua warga !']);
    }
}
