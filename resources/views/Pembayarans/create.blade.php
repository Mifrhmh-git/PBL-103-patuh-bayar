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
    <title>Add Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">

                        <form action="{{ route('Pembayarans.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="pb-3">
                                <a href="{{ route('Pembayarans.index') }}" class="btn btn-md btn-success mb-3"><b>Kembali</b></a>
                            </div>

                            <div class="form-group">
                                <label for="id_warga" class="font-weight-bold">Data Warga</label>
                                <select id="id_warga" class="form-control @error('id_warga') is-invalid @enderror select2" name="id_warga">
                                    <option value="" disabled selected>-- Cari atau Pilih NIK --</option>
                                    @foreach ($wargaOptions as $warga)
                                        <option value="{{ $warga->id_warga }}" {{ old('id_warga') == $warga->id_warga ? 'selected' : '' }}>
                                            {{ $warga->nik }} - {{ $warga->nama }} ( RT : {{ $warga->rt }} )
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_warga')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <script>
                                $(document).ready(function() {
                                    $('#id_warga').select2({
                                        placeholder: '-- Cari atau Pilih NIK --',
                                        allowClear: true,
                                    });
                                });
                            </script>

                            <div class="form-group">
                                <label class="font-weight-bold">Tanggal Pembayaran</label>
                                <input type="date" class="form-control @error('tanggal_pembayaran') is-invalid @enderror" name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran') }}" placeholder="Masukkan Tanggal Pembayaran">
                                @error('tanggal_pembayaran')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class=" font-weight-bold">Status Pembayaran</label>
                                <select class="form-control @error('status_pembayaran') is-invalid @enderror" name="status_pembayaran">
                                    <option value="">-- Pilih Status Pembayaran --</option>
                                    <option value="Belum Lunas" {{ old('status_pembayaran') == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas</option>
                                    <option value="Lunas" {{ old('status_pembayaran') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                </select>
                                @error('status_pembayaran')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Bukti Pembayaran</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                @error('image')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <br>
                            <button type="submit" class="btn btn-md btn-success"><b>Simpan</b></button>
                            <button type="reset" class="btn btn-md btn-dark"><b>Reset</b></button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "-- Cari atau Pilih NIK --",
            allowClear: true
        });
    });
</script>

<script>
    CKEDITOR.replace( 'content' );
</script>
</body>
</html>
@endsection
