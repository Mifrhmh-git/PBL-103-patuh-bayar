@extends('layout.main')

@section('judul')
    Halaman Edit Data
@endsection

@section('isi')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data Pembayaran</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <div class="pb-3">
                            <a href="{{ route('Pembayarans.index') }}" class="btn btn-md btn-success mb-3"><b>Kembali</b></a>
                        </div>

                        <h5 class="font-weight-bold">Edit Data Pembayaran</h5>
                        <hr>

                        <form action="{{ route('Pembayarans.update', $post->id_bayar) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">NIK</label>
                                <input type="text" class="form-control" name="nik" value="{{ old('nik', $post->Warga->nik) }}" readonly>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control" name="nama" value="{{ old('nama', $post->Warga->nama) }}" readonly>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">RT</label>
                                <input type="text" class="form-control" name="rt" value="{{ old('rt', $post->Warga->rt) }}" readonly>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Pembayaran</label>
                                <input type="date" class="form-control @error('tanggal_pembayaran') is-invalid @enderror" name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran', $post->tanggal_pembayaran) }}">
                                @error('tanggal_pembayaran')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Status Pembayaran</label>
                                <select class="form-control @error('status_pembayaran') is-invalid @enderror" name="status_pembayaran">
                                    <option value="">Pilih Status</option>
                                    <option value="Lunas" {{ old('status_pembayaran', $post->status_pembayaran) == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                    <option value="Belum Lunas" {{ old('status_pembayaran', $post->status_pembayaran) == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                </select>
                                @error('status_pembayaran')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tambahkan kolom untuk unggah file -->
                            <div class="form-group">
                                <label class="font-weight-bold">Upload Bukti Pembayaran</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">

                                {{-- Periksa jika ada gambar --}}
                                @if($post->image)
                                    <p class="mt-2">
                                        File saat ini :
                                        <a href="{{ asset('storage/Pembayarans/' . $post->image) }}" target="_blank">Lihat Bukti Pembayaran</a>
                                    </p>
                                @endif

                                {{-- Pesan Error --}}
                                @error('image')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tombol -->
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="{{ route('Pembayarans.index') }}" class="btn btn-dark">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

@endsection
