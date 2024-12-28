@extends('layout.main')

@section('judul')
    <div style="text-align: left; font-size: 30px; color: #000000; font-weight: bold; padding: 10px;">
    Detail Bulan Ini
    </div>
@endsection

@section('isi')

<div class="row">

    <!-- Card untuk Jumlah Seluruh Warga -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card bg-primary text-white shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-sm mb-1">Jumlah Seluruh Warga</p>
                        <h4 class="mb-0 font-weight-bold">{{ \App\Models\Warga::count() }}</h4>
                    </div>
                    <i class="fas fa-users fa-3x text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Card untuk Pembayaran Lunas dan Belum Lunas Bulan Ini -->
    @php
        $tahunSekarang = date('Y');
        $totalWarga = \App\Models\Warga::count();
        $bulanIni = date('n');
        $pembayaranLunasBulan = \App\Models\Pembayaran::whereYear('tanggal_pembayaran', $tahunSekarang)
            ->whereMonth('tanggal_pembayaran', $bulanIni)
            ->where('status_pembayaran', 'lunas')->count();
        $pembayaranBelumLunasBulan = $totalWarga - $pembayaranLunasBulan;
        $bulanNama = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
    @endphp
    <!-- Card : Pembayaran Lunas Bulan Ini -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card bg-success text-white shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-sm mb-1">Pembayaran Lunas Bulan Ini ( {{ $bulanNama[$bulanIni] }} )</p>
                        <h4 class="mb-0 font-weight-bold">{{ $pembayaranLunasBulan }}</h4>
                    </div>
                    <i class="fas fa-check fa-3x text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Card : Pembayaran Belum Lunas Bulan Ini -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card bg-danger text-white shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-sm mb-1">Pembayaran Belum Lunas Bulan Ini ( {{ $bulanNama[$bulanIni] }} )</p>
                        <h4 class="mb-0 font-weight-bold">{{ $pembayaranBelumLunasBulan }}</h4>
                    </div>
                    <i class="fas fa-times fa-3x text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Card untuk Pembayaran Lunas dan Belum Lunas per Tahun -->
    @php
        $pembayaranLunasTahun = \App\Models\Pembayaran::whereYear('tanggal_pembayaran', $tahunSekarang)
            ->where('status_pembayaran', 'lunas')->count();
        $pembayaranBelumLunasTahun = $totalWarga * 12 - $pembayaranLunasTahun;
    @endphp
    <!-- Card: Pembayaran Lunas Tahun Ini -->
    {{-- <div class="col-xl-4 col-md-6 mb-4">
        <div class="card bg-info text-white shadow-sm">
            <div class="card-body">
                <div>
                    <p class="text-sm mb-1">Pembayaran Lunas Tahun Ini ({{ $tahunSekarang }})</p>
                    <h4 class="mb-0 font-weight-bold">{{ $pembayaranLunasTahun }}</h4>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Card: Pembayaran Belum Lunas Tahun Ini -->
    {{-- <div class="col-xl-4 col-md-6 mb-4">
        <div class="card bg-warning text-white shadow-sm">
            <div class="card-body">
                <div>
                    <p class="text-sm mb-1">Pembayaran Belum Lunas Tahun Ini ({{ $tahunSekarang }})</p>
                    <h4 class="mb-0 font-weight-bold">{{ $pembayaranBelumLunasTahun }}</h4>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Card untuk Jumlah Pemasukkan Bulan Ini -->
    @php
        $htmPerBulan = 35000;
        $pemasukkanBulan = $pembayaranLunasBulan * $htmPerBulan;
    @endphp
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card bg-secondary text-white shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-sm mb-1">Pemasukkan Bulan Ini ( {{ $bulanNama[$bulanIni] }} )</p>
                        <h4 class="mb-0 font-weight-bold">Rp {{ number_format($pemasukkanBulan, 0, ',', '.') }}</h4>
                    </div>
                    <i class="fas fa-wallet fa-3x text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Card untuk Jumlah Pemasukkan per Tahun -->
    @php
        $pemasukkanTahun = $pembayaranLunasTahun * $htmPerBulan;
    @endphp
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card bg-dark text-white shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-sm mb-1">Jumlah Pemasukkan Tahun Ini ( {{ $tahunSekarang }} )</p>
                        <h4 class="mb-0 font-weight-bold">Rp {{ number_format($pemasukkanTahun, 0, ',', '.') }}</h4>
                    </div>
                    <i class="fas fa-wallet fa-3x text-white"></i>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Dropdown Tahun -->
<div class="col-md-12 mb-4">
    <form method="GET">
        <div class="input-group">
            <select name="tahun" class="form-control me-1" onchange="this.form.submit()">
                <option value="">--Pilih Tahun--</option>
                @foreach(range(date('Y'), 2025) as $year)
                    <option value="{{ $year }}" @if(request('tahun') == $year) selected @endif>{{ $year }}</option>
                @endforeach
            </select>
        </div>
    </form>
</div>

<!-- Tabel Rekap Pembayaran 1 tahun dari januari - desember -->
<div class="card mt-4">
    <div class="card-header">
        <h5>Rekap Pembayaran per Bulan</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Jumlah Warga Lunas</th>
                    <th>Jumlah Warga Belum Lunas</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $tahun = Request::get('tahun');
                    $query = \App\Models\Pembayaran::selectRaw('MONTH(tanggal_pembayaran) as bulan')
                        ->distinct()
                        ->orderBy('bulan', 'asc');

                    if ($tahun) {
                        $query->whereYear('tanggal_pembayaran', $tahun);
                    }

                    $bulanData = $query->get();
                    $totalPembayaranTahun = 0;
                @endphp

                @php
                use Carbon\Carbon;
                Carbon::setLocale('id');
                @endphp

                @foreach ($bulanData as $data)
                @php
                    $bulan = $data->bulan;

                    // Counting residents who paid ('lunas') for each month
                    $jumlahLunas = \App\Models\Pembayaran::whereYear('tanggal_pembayaran', $tahun)
                        ->whereMonth('tanggal_pembayaran', $bulan)
                        ->where('status_pembayaran', 'lunas')
                        ->count();

                    // Counting residents who haven't paid ('belum lunas') for each month
                    $jumlahBelumLunas = \App\Models\Warga::count() - $jumlahLunas;

                    // Add to total payment (35,000 per resident per month)
                    $totalPembayaranTahun += $jumlahLunas * 35000;
                @endphp
                <tr>
                    <!-- Menampilkan bulan dalam Bahasa Indonesia menggunakan Carbon -->
                    <td>{{ Carbon::create()->month($bulan)->translatedFormat('F') }}</td>
                    <td>{{ $jumlahLunas }}</td>
                    <td>{{ $jumlahBelumLunas }}</td>
                </tr>
                @endforeach

                @if($bulanData->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada data untuk tahun yang dipilih</td>
                    </tr>
                @endif
            </tbody>
        </table>

        @if($tahun)
            <div class="mt-3">
                <strong>Total Pembayaran Tahun {{ $tahun }} : Rp {{ number_format($totalPembayaranTahun, 0, ',', '.') }}</strong>
            </div>
        @endif
    </div>
</div>

@endsection
