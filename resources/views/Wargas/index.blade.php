@section('konten')
@extends('layout.main')

@section('judul')
    <div style="text-align: left; font-size: 30px; color: #000000; font-weight: bold; padding: 10px;">
    Halaman Data Warga
    </div>
@endsection

@section('isi')
<div class="card">

    <div class="card-body">
        <div class="my-3 p-3 bg-body rounded shadow-sm">

            <!-- FORM PENCARIAN DAN FILTER SESUAI RT -->
            <div class="pb-3">
                <form class="d-flex" action="{{ url('Wargas') }}" method="get">
                    <input class="form-control me-1" type="search" name="katakunci"
                        value="{{ Request::get('katakunci') }}" placeholder="Masukkan Kata Kunci" aria-label="Search">
                    <select class="form-control me-1" name="rt">
                        <option value="">-- Semua RT --</option>
                        @foreach ($rts as $rtOption)
                            <option value="{{ $rtOption }}" {{ Request::get('rt') == $rtOption ? 'selected' : '' }}>
                                {{ $rtOption }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-outline-success" type="submit">Filter</button>
                </form>
            </div>

            <!-- TOMBOL EXPORT DATA -->
            <div class="float-right">
                <a href="{{ route('Wargas.export.excel') }}" class="btn btn-md btn-dark mb-3"><i class='fas fa-file-excel'></i></a>
                <a href="{{ route('Wargas.export.pdf') }}" class="btn btn-md btn-danger mb-3"><i class='fas fa-file-pdf'></i></a>
            </div>

            <!-- TOMBOL TAMBAH DATA -->
            @if (auth()->user()->role == 'bendahara')
                <div class="pb-3">
                    <a href="{{ route('Wargas.create') }}" class="btn btn-md btn-success mb-3"><b>Tambah Data</b></a>
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
                        <th scope="col">Alamat</th>
                        <th scope="col">Email</th>
                        <th scope="col">No.Telp</th>
                        @if (auth()->user()->role == 'bendahara')
                        <th scope="col">Options</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($Wargas as $index => $post)
                        <tr align="center">
                            <td>{{ $loop->iteration + ($Wargas->currentPage() - 1) * $Wargas->perPage() }}</td>
                            <td>{{ $post->nik }}</td>
                            <td>{!! $post->nama !!}</td>
                            <td>{!! $post->rt !!}</td>
                            <td>{!! $post->alamat !!}</td>
                            <td>{!! $post->email !!}</td>
                            <td>{!! $post->no_telp !!}</td>
                            @if (auth()->user()->role == 'bendahara')
                            <td class="text-center">
                                <form onsubmit="return confirm('Kamu yakin ?');" action="{{ route('Wargas.destroy', $post->id_warga) }}" method="POST">
                                    <a href="{{ route('Wargas.edit', $post->id_warga) }}" class="btn btn-sm btn-dark">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center alert alert-danger">Tidak ada data warga</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $Wargas->withQueryString()->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </div>
</div>

@endsection
