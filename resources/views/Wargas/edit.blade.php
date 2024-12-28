@section('konten')
@extends('layout.main')

@section('judul')
        Halaman Tambah Data
@endsection

@section('isi')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Edit Data </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('Wargas.update', $post->id_warga) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="pb-3">
                                <a href="{{ route('Wargas.index') }}" class="btn btn-md btn-dark mb-3"><b>Kembali</b></a>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">NIK</label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik', $post->nik) }}" placeholder="Masukkan NIK Anda">

                                <!-- error message untuk title -->
                                @error('nik')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $post->nama) }}" placeholder="Masukkan Nama Anda">

                                <!-- error message untuk title -->
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">RT</label>
                                <select class="form-control @error('rt') is-invalid @enderror" name="rt">
                                    <option value="">Pilih RT</option>
                                    <option value="1" {{ old('rt', $post->rt) == '1' ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ old('rt', $post->rt) == '2' ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ old('rt', $post->rt) == '3' ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ old('rt', $post->rt) == '4' ? 'selected' : '' }}>4</option>
                                </select>
                                @error('rt')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat', $post->alamat) }}" placeholder="Masukkan Alamat Anda">

                                <!-- error message untuk title -->
                                @error('alamat')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $post->email) }}" placeholder="Masukkan Email Anda">

                                <!-- error message untuk title -->
                                @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">No. Telp</label>
                                <input type="text"
                                       id="no_telp"
                                       class="form-control @error('no_telp') is-invalid @enderror"
                                       name="no_telp"
                                       value="{{ old('no_telp', $post->no_telp) }}"
                                       placeholder="Masukkan Nomor Telepon Anda"
                                       oninput="addCountryCode()">

                                <!-- Error message untuk title -->
                                @error('no_telp')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <script>
                                function addCountryCode() {
                                    let inputField = document.getElementById('no_telp');
                                    let value = inputField.value;

                                    // Tambahkan +62 jika belum ada di awal input
                                    if (!value.startsWith('+62')) {
                                        if (value.startsWith('0')) {
                                            // Ganti 0 di awal dengan +62
                                            inputField.value = '+62' + value.slice(1);
                                        } else if (!value.startsWith('+')) {
                                            // Tambahkan +62 jika input awal kosong atau angka lain
                                            inputField.value = '+62' + value;
                                        }
                                    }
                                }

                                // Tambahkan kode negara pada halaman jika field sudah terisi tanpa +62
                                document.addEventListener("DOMContentLoaded", function() {
                                    let inputField = document.getElementById('no_telp');
                                    let value = inputField.value;

                                    if (value && !value.startsWith('+62')) {
                                        if (value.startsWith('0')) {
                                            inputField.value = '+62' + value.slice(1);
                                        } else if (!value.startsWith('+')) {
                                            inputField.value = '+62' + value;
                                        }
                                    }
                                });
                            </script>

                            <button type="submit" class="btn btn-md btn-success"><b>Ubah</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'content' );
</script>
</body>
</html>
@endsection
