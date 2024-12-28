@section('konten')
@extends('layout.main')

@section('isi')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Tambah Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Formulir Tambah Data</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Wargas.store') }}" method="POST" enctype="multipart/form-data">

                            @csrf

                            <div class="pb-3">
                                <a href="{{ route('Wargas.index') }}" class="btn btn-md btn-success mb-3"><b>Kembali</b></a>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama">
                                @error('nama')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">NIK</label>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" placeholder="Masukkan NIK" required>

                                    @error('nik')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">RT</label>
                                    <select class="form-control @error('rt') is-invalid @enderror" name="rt" required>
                                        <option value="" disabled selected>Pilih RT</option>
                                        @for ($i = 1; $i <= 4; $i++)
                                            <option value="{{ $i }}" {{ old('rt') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>

                                    @error('rt')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat">
                                @error('alamat')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Masukkan Email Anda" required>

                                    @error('email')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label class="font-weight-bold">No. Telp</label>
                                    <input type="text"
                                           id="no_telp"
                                           class="form-control @error('no_telp') is-invalid @enderror"
                                           name="no_telp"
                                           value="{{ old('no_telp') }}"
                                           placeholder="Masukkan Nomor Telepon Anda"
                                           required
                                           oninput="addCountryCode()">

                                    @error('no_telp')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Script Untuk no. telp --}}
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
                                </script>

                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-md btn-success"><i class="fas fa-save"></i> <b>Simpan</b></button>
                                <button type="reset" class="btn btn-md btn-dark"><i class="fas fa-undo"></i> <b>Atur Ulang</b></button>
                            </div>

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
    CKEDITOR.replace('content');
</script>
</body>
</html>
@endsection
