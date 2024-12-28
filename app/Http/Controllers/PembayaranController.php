<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Mail\JatuhTempoNotification;
use App\Models\Pembayaran;
use App\Models\Warga;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Dompdf\Dompdf;
use Dompdf\Options;

class PembayaranController extends Controller
{
    /**
     * Menampilkan daftar pembayaran dengan filter yang sesuai.
     *
     * @param Request $request Objek permintaan HTTP.
     * @return \Illuminate\View\View Tampilan daftar pembayaran.
     */
    public function index(Request $request): View
    {
        // Mendapatkan daftar RT yang unik untuk filter
        $rtList = Warga::distinct()->pluck('rt')->sort()->toArray();

        // Membuat query untuk mengambil data pembayaran
        $query = Pembayaran::query();

        // Filter berdasarkan kata kunci (nik, nama, atau rt)
        if ($request->filled('katakunci')) {
            $query->whereHas('warga', function ($subQuery) use ($request) {
                $subQuery->where('nik', 'like', '%' . $request->get('katakunci') . '%')
                         ->orWhere('nama', 'like', '%' . $request->get('katakunci') . '%')
                         ->orWhere('rt', 'like', '%' . $request->get('katakunci') . '%');
            });
        }

        // Filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_pembayaran', $request->get('tahun'));
        }

        // Filter berdasarkan bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_pembayaran', $request->get('bulan'));
        }

        // Filter berdasarkan RT
        if ($request->filled('rt')) {
            $query->whereHas('warga', function ($q) use ($request) {
                $q->where('rt', $request->get('rt'));
            });
        }

        // Mengambil data pembayaran dengan pagination
        $Pembayarans = $query->latest()->paginate(10);

        // Mengembalikan tampilan daftar pembayaran
        return view('Pembayarans.index', compact('Pembayarans', 'rtList'))->with(['title' => 'Data Pembayaran']);
    }

    /**
     * Mengekspor data pembayaran ke dalam format Excel.
     *
     * @return void
     */
    public function exportExcel()
    {
        $Pembayarans = Pembayaran::all();

        // Set header untuk file Excel
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="data-pembayaran.xls"');
        header('Cache-Control: no-cache');
        header('Pragma: no-cache');

        // Generate konten file Excel
        echo '<table border="1">';
        echo '<tr>
                <th>No.</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>RT</th>
                <th>Bulan Pembayaran</th>
                <th>Tanggal Pembayaran</th>
                <th>Status Pembayaran</th>
            </tr>';
            foreach ($Pembayarans as $index => $post) {
            echo '<tr>';
            echo '<td>' . ($index + 1) . '</td>';
            echo '<td>' . $post->Warga->nik . '</td>';
            echo '<td>' . $post->Warga->nama . '</td>';
            echo '<td>' . $post->Warga->rt . '</td>';
            echo '<td>' . \Carbon\Carbon::parse($post->tanggal_pembayaran)->locale('id')->translatedFormat('F') . '</td>';
            echo '<td>' . $post->tanggal_pembayaran . '</td>';
            echo '<td>' . $post->status_pembayaran . '</td>';
            echo '</tr>';
        }
        echo '</table>';
        exit;
    }

    /**
     * Mengekspor data warga ke dalam format PDF.
     *
     * @return void
     */
    public function exportPdf()
    {
        $Pembayarans = Pembayaran::all();

        // Inisialisasi Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        // Generate konten file PDF
        $html = '<h1>Data Pembayaran</h1>';
        $html .= '<table border="1" cellpadding="5" cellspacing="0">';
        $html .= '<tr>
                    <th>No.</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>RT</th>
                    <th>Bulan Pembayaran</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Status Pembayaran</th>
                </tr>';

            foreach ($Pembayarans as $index => $post) {
            $html .= '<tr>';
            $html .= '<td>' . ($index + 1) . '</td>';
            $html .= '<td>' . $post->Warga->nik . '</td>';
            $html .= '<td>' . $post->Warga->nama . '</td>';
            $html .= '<td>' . $post->Warga->rt . '</td>';
            $html .= '<td>' . \Carbon\Carbon::parse($post->tanggal_pembayaran)->locale('id')->translatedFormat('F') . '</td>';
            $html .= '<td>' . $post->tanggal_pembayaran . '</td>';
            $html .= '<td>' . $post->status_pembayaran . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Set ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF
        $dompdf->render();

        // Output PDF ke browser
        $dompdf->stream('data-pembayaran.pdf', ['Attachment' => true]);
        exit;
    }

    /**
     * Menampilkan halaman form untuk membuat pembayaran baru.
     *
     * @return \Illuminate\View\View Tampilan form pembayaran baru.
     */
    public function create(): View
    {
        // Mendapatkan daftar warga untuk pilihan dalam form
        $wargaOptions = Warga::all();
        return view('Pembayarans.create', compact('wargaOptions'), ['title' => 'Tambah Data Pembayaran']);
    }

    /**
     * Menyimpan data pembayaran baru ke database.
     *
     * @param Request $request Objek permintaan HTTP.
     * @return \Illuminate\Http\RedirectResponse Redirect ke halaman daftar pembayaran.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi data input dari form
        $request->validate([
            'id_warga' => 'required',
            'tanggal_pembayaran' => 'required|date',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        // Menyimpan gambar pembayaran
        $image = $request->file('image');
        $image->storeAs('Pembayarans', $image->hashName(), 'public');

        // Menentukan status pembayaran (lunas)
        $status = 'lunas';

        // Menyimpan data pembayaran baru
        Pembayaran::create([
            'id_warga' => $request->id_warga,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'status_pembayaran' => $status,
            'image' => $image->hashName()
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('Pembayarans.index')->with(['success' => 'Data berhasil disimpan!']);
    }

    /**
     * Menampilkan detail pembayaran berdasarkan ID.
     *
     * @param string $id_bayar ID pembayaran.
     * @return \Illuminate\View\View Tampilan detail pembayaran.
     */
    public function show(string $id_bayar): View
    {
        // Mendapatkan data pembayaran berdasarkan ID
        $post = Pembayaran::findOrFail($id_bayar);

        // Mendapatkan ID warga yang terkait dengan pembayaran
        $id_warga = $post->id_warga;

        // Mendapatkan status pembayaran per bulan untuk tahun ini
        $tahun = date('Y');
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        $paymentStatuses = [];
        foreach (range(1, 12) as $month) {
            // Mengecek apakah pembayaran dilakukan pada bulan tersebut
            $payment = Pembayaran::whereYear('tanggal_pembayaran', $tahun)
                ->whereMonth('tanggal_pembayaran', $month)
                ->where('status_pembayaran', 'lunas')
                ->where('id_warga', $id_warga)
                ->first();

            // Menentukan status pembayaran
            $status = $payment ? 'Lunas' : 'Belum Lunas';
            $paymentStatuses[$month] = [
                'month' => $months[$month],
                'status' => $status,
            ];
        }

        // Mengembalikan tampilan dengan data pembayaran dan status per bulan
        return view('Pembayarans.show', compact('post', 'paymentStatuses'), ['title' => 'Detail Pembayaran']);
    }

    /**
     * Menampilkan halaman form untuk mengedit pembayaran.
     *
     * @param string $id_bayar ID pembayaran.
     * @return \Illuminate\View\View Tampilan form edit pembayaran.
     */
    public function edit(string $id_bayar): View
    {
        // Mendapatkan data pembayaran dan warga untuk pilihan dalam form
        $post = Pembayaran::findOrFail($id_bayar);
        $wargaOptions = Warga::all();
        return view('Pembayarans.edit', compact('post', 'wargaOptions'), ['title' => 'Edit Data Pembayaran']);
    }

    /**
     * Memperbarui data pembayaran yang telah ada.
     *
     * @param Request $request Objek permintaan HTTP.
     * @param string $id_bayar ID pembayaran.
     * @return \Illuminate\Http\RedirectResponse Redirect ke halaman daftar pembayaran.
     */
    public function update(Request $request, string $id_bayar): RedirectResponse
    {
        // Validasi data input dari form
        $request->validate([
            'tanggal_pembayaran' => 'required|date',
            'status_pembayaran' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mendapatkan data pembayaran yang akan diubah
        $Pembayarans = Pembayaran::findOrFail($id_bayar);
        $Pembayarans->tanggal_pembayaran = $request->tanggal_pembayaran;
        $Pembayarans->status_pembayaran = $request->status_pembayaran;

        // Mengubah gambar jika ada
        if ($request->hasFile('image')) {
            // Menghapus gambar lama jika ada
            if ($Pembayarans->image) {
                Storage::disk('public')->delete('Pembayarans/' . $Pembayarans->image);
            }

            // Menyimpan gambar baru
            $image = $request->file('image');
            $imagePath = $image->storeAs('Pembayarans', $image->hashName(), 'public');
            $Pembayarans->image = $image->hashName();
        }

        // Menyimpan perubahan data
        $Pembayarans->save();

        // Redirect dengan pesan sukses
        return redirect()->route('Pembayarans.index')->with('success', 'Data Berhasil diubah!');
    }

    /**
     * Menghapus data pembayaran.
     *
     * @param string $id_bayar ID pembayaran.
     * @return \Illuminate\Http\RedirectResponse Redirect ke halaman daftar pembayaran.
     */
    public function destroy(string $id_bayar): RedirectResponse
    {
        // Mendapatkan data pembayaran yang akan dihapus
        $post = Pembayaran::findOrFail($id_bayar);

        // Menghapus gambar yang terkait dengan pembayaran
        Storage::delete('public/Pembayarans/' . $post->image);

        // Menghapus data pembayaran
        $post->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('Pembayarans.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
