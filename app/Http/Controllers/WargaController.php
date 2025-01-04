<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;
use Dompdf\Options;

class WargaController extends Controller
{
    /**
     * Menampilkan daftar warga dengan filter pencarian dan RT.
     *
     * @param Request $request
     * @return \Illuminate\View\View Tampilan daftar warga
     */
    public function index(Request $request): View
    {
        // Mengambil nilai input pencarian dan RT dari permintaan
        $katakunci = $request->input('katakunci');
        $rt = $request->input('rt');

        // Ambil daftar RT yang ada pada Warga dan urutkan
        $rts = Warga::distinct()->pluck('rt')->sort();

        // Dapatkan level pengguna (admin, user, dll.)
        $role = auth()->user()->level;

        // Query untuk menampilkan daftar Warga dengan filter pencarian dan RT
        $Wargas = Warga::query()
            ->when($katakunci, function ($query, $katakunci) {
                return $query->where(function ($subQuery) use ($katakunci) {
                    $subQuery->where('nama', 'like', "%$katakunci%")
                             ->orWhere('nik', 'like', "%$katakunci%")
                             ->orWhere('alamat', 'like', "%$katakunci%");
                });
            })
            ->when($rt, function ($query, $rt) {
                return $query->where('rt', $rt);
            })
            ->latest()
            ->paginate(10)
            ->appends(['katakunci' => $katakunci, 'rt' => $rt]);

        // Kirim data ke view dengan peran pengguna
        return view('Wargas.index', compact('Wargas', 'rts', 'katakunci', 'rt', 'role'))->with(['title' => 'Data Warga',]);
    }

    /**
     * Mengekspor data warga ke dalam format Excel.
     *
     * @return void
     */
    public function exportExcel()
    {
        $Wargas = Warga::all();

        // Set header untuk file Excel
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="data-warga.xls"');
        header('Cache-Control: no-cache');
        header('Pragma: no-cache');

        // Generate konten file Excel
        echo '<table border="1">';
        echo '<tr>
                <th>No.</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>RT</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>No.Telp</th>
            </tr>';
        foreach ($Wargas as $index => $warga) {
            echo '<tr>';
            echo '<td>' . ($index + 1) . '</td>';
            echo '<td>' . $warga->nik . '</td>';
            echo '<td>' . $warga->nama . '</td>';
            echo '<td>' . $warga->rt . '</td>';
            echo '<td>' . $warga->alamat . '</td>';
            echo '<td>' . $warga->email . '</td>';
            // Tambahkan tanda petik di sekitar no_telp agar dianggap sebagai string oleh Excel
            echo '<td>\'' . $warga->no_telp . '</td>';
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
        $Wargas = Warga::all();

        // Inisialisasi Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        // Generate konten file PDF
        $html = '<h1>Data Warga</h1>';
        $html .= '<table border="1" cellpadding="5" cellspacing="0">';
        $html .= '<tr>
                    <th>No.</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>RT</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>No.Telp</th>
                </tr>';

        foreach ($Wargas as $index => $warga) {
            $html .= '<tr>';
            $html .= '<td>' . ($index + 1) . '</td>';
            $html .= '<td>' . $warga->nik . '</td>';
            $html .= '<td>' . $warga->nama . '</td>';
            $html .= '<td>' . $warga->rt . '</td>';
            $html .= '<td>' . $warga->alamat . '</td>';
            $html .= '<td>' . $warga->email . '</td>';
            $html .= '<td>' . $warga->no_telp . '</td>';
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
        $dompdf->stream('data-warga.pdf', ['Attachment' => true]);
        exit;
    }

    /**
     * Menampilkan form untuk menambahkan warga baru.
     *
     * @return \Illuminate\View\View Tampilan form tambah warga
     */
    public function create(): View
    {
        return view('Wargas.create', ['title' => 'Tambah Data Warga']);
    }

    /**
     * Menyimpan data warga baru ke dalam database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse Redirect ke halaman daftar warga
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nik'     => 'required',
            'nama'    => 'required',
            'rt'      => 'required',
            'alamat'  => 'required',
            'email'   => 'required',
            'no_telp' => 'required',
        ]);

        // Simpan data warga baru
        Warga::create($request->all());

        // Redirect setelah data berhasil disimpan
        return redirect()->route('Wargas.index')->with(['success' => 'Data berhasil ditambahkan!']);
    }

    /**
     * Menampilkan form untuk mengedit data warga.
     *
     * @param string $id_warga
     * @return \Illuminate\View\View Tampilan form edit warga
     */
    public function edit(string $id_warga): View
    {
        // Ambil data warga berdasarkan ID
        $post = Warga::findOrFail($id_warga);

        // Tampilkan form edit dengan data warga
        return view('Wargas.edit', compact('post'), ['title' => 'Edit Data Warga']);
    }

    /**
     * Memperbarui data warga yang ada.
     *
     * @param Request $request
     * @param string $id_warga
     * @return \Illuminate\Http\RedirectResponse Redirect ke halaman daftar warga
     */
    public function update(Request $request, string $id_warga): RedirectResponse
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nik'     => 'required',
            'nama'    => 'required',
            'rt'      => 'required',
            'alamat'  => 'required',
            'email'   => 'required',
            'no_telp' => 'required',
        ]);

        // Ambil data warga yang akan diperbarui
        $post = Warga::findOrFail($id_warga);
        $post->update($request->all());

        // Redirect setelah data berhasil diperbarui
        return redirect()->route('Wargas.index')->with(['success' => 'Data berhasil diubah!']);
    }

    /**
     * Menghapus data warga dari database.
     *
     * @param string $id_warga
     * @return \Illuminate\Http\RedirectResponse Redirect ke halaman daftar warga
     */
    public function destroy(string $id_warga): RedirectResponse
    {
        // Ambil data warga yang akan dihapus
        $warga = Warga::findOrFail($id_warga);

        // Hapus semua pembayaran yang terkait
        $warga->pembayarans()->delete();

        // Hapus data warga
        $warga->delete();

        // Redirect setelah data berhasil dihapus
        return redirect()->route('Wargas.index')->with(['success' => 'Data berhasil dihapus!']);
    }

}
