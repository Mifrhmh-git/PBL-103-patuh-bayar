@section('konten')
@extends('layout.main')

@section('judul')
    <div style="text-align: left; font-size: 30px; color: #000000; font-weight: bold; padding: 10px;">
        Halaman Data Pembayaran
    </div>
@endsection

@section('isi')
<div class="card">

    <div class="card-body">
        <div class="my-3 p-3 bg-body rounded shadow-sm">

            <!-- FORM PENCARIAN -->
            <div class="pb-3">
                <form class="d-flex" action="{{ url('Pembayarans') }}" method="get">
                    <input class="form-control me-1" type="search" name="katakunci"
                        value="{{ Request::get('katakunci') }}" placeholder="Masukkan Kata Kunci" aria-label="Search">

                    <!-- Dropdown for Year -->
                    <select class="form-control me-1" name="tahun" aria-label="Select Year">
                        <option value="">-- Pilih Tahun --</option>
                        @foreach(range(date('Y'), 2025) as $year)
                            <option value="{{ $year }}" {{ Request::get('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>

                    <!-- Dropdown for Month -->
                    <select class="form-control me-1" name="bulan" aria-label="Select Month">
                        <option value="">-- Pilih Bulan --</option>
                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}" {{ Request::get('bulan') == $month ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->locale('id')->month($month)->translatedFormat('F') }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Dropdown for RT -->
                    <select class="form-control me-1" name="rt" aria-label="Select RT">
                        <option value="">-- Pilih RT --</option>
                        @foreach($rtList as $rt)
                            <option value="{{ $rt }}" {{ Request::get('rt') == $rt ? 'selected' : '' }}>{{ $rt }}</option>
                        @endforeach
                    </select>

                    <button class="btn btn-outline-success" type="submit">Cari</button>

                </form>
            </div>

            <!-- TOMBOL EXPORT DATA -->
            <div class="float-right">
                @csrf
                @if (auth()->user()->role == 'bendahara')
                <a href="{{ route('send_email') }}"><button type="submit" class="btn btn-md btn-success mb-3"><i class="fas fa-envelope"></i></button></a>
                <a href="{{ route('Pembayarans.export.excel') }}" class="btn btn-md btn-dark mb-3"><i class='fas fa-file-excel'></i></a>
                <a href="{{ route('Pembayarans.export.pdf') }}" class="btn btn-md btn-danger mb-3"><i class='fas fa-file-pdf'></i></a>
                @elseif (auth()->user()->role == 'rw')
                <a href="{{ route('Pembayarans.export.excel') }}" class="btn btn-md btn-dark mb-3"><i class='fas fa-file-excel'></i></a>
                <a href="{{ route('Pembayarans.export.pdf') }}" class="btn btn-md btn-danger mb-3"><i class='fas fa-file-pdf'></i></a>
                @endif
            </div>

            <!-- TOMBOL TAMBAH DATA -->
            @if (auth()->user()->role == 'bendahara')
            <div class="pb-3 d-flex justify-content-start gap-3">
                <!-- Tombol Tambah Data -->
                <a href="{{ route('Pembayarans.create') }}" class="btn btn-md btn-success mb-3">
                    <b>Tambah Data</b>
                </a>
                <hr>
            </div>
            @endif

            <div class="table-responsive">
            <table class="table table-striped table-bordered table-sm">
                <thead class="table-success">
                    <tr align="center">
                        <th scope="col">No.</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">RT</th>
                        <th scope="col">Bulan</th>
                        <th scope="col">Tanggal Pembayaran</th>
                        <th scope="col">Status Pembayaran</th>
                        <th scope="col">Bukti Pembayaran</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($Pembayarans as $post)
                        <tr align="center">
                            <td>{{ $loop->iteration + ($Pembayarans->currentPage() - 1) * $Pembayarans->perPage() }}</td>
                            <td>{{ $post->Warga->nik }}</td>
                            <td>{{ $post->Warga->nama }}</td>
                            <td>{{ $post->Warga->rt }}</td>
                            <td>{{ \Carbon\Carbon::parse($post->tanggal_pembayaran)->locale('id')->translatedFormat('F') }}</td>
                            <td>{{ $post->tanggal_pembayaran }}</td>
                            <td>{{ $post->status_pembayaran }}</td>
                            <td class="text-center">
                                @if ($post->image)
                                    <img src="{{ asset('storage/Pembayarans/'.$post->image) }}" class="rounded" style="width: 100px">
                                @else
                                    <span>Gambar tidak tersedia</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if (auth()->user()->role == 'bendahara')
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('Pembayarans.destroy', $post->id_bayar) }}" method="POST">
                                        <a href="{{ route('Pembayarans.edit', $post->id_bayar) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('Pembayarans.show', $post->id_bayar) }}" class="btn btn-sm btn-dark"><i class="fas fa-info-circle"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                @elseif (auth()->user()->role == 'rw')
                                    <a href="{{ route('Pembayarans.show', $post->id_bayar) }}" class="btn btn-sm btn-dark"><i class="fas fa-info-circle"></i></a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" align="center">
                                <div class="alert alert-danger">
                                    Data tidak tersedia.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $Pembayarans->withQueryString()->links('pagination::bootstrap-5') }}
            </div>

        </div>
    </div>
</div>

@endsection
