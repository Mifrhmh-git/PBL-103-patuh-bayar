@extends('layout.main')

@section('isi')
<div class="container my-5">

    <!-- Judul Halaman -->
    <div class="text-center my-4">
        <h1 class="text-success font-weight-bold">Halaman Profil</h1>
        <p class="text-muted">Kelola informasi akun dan foto profil Anda di sini.</p>
        <hr class="border-success" style="width: 50%; margin: auto;">
    </div>

    <div class="row">
        <!-- Kolom Kiri : Foto Profil -->
        <div class="col-md-3">
            <div class="card border-success shadow">
                <div class="card-body text-center">
                    <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/default-profile.png') }}" alt="Foto Profil" class="rounded-circle mb-3 border border-success" width="150">
                    <form action="{{ route('profil.updateImage') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="file" name="image" class="form-control border-success mb-2">
                        <button class="btn btn-outline-success btn-sm mt-2" type="submit">Upload Foto</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan : Informasi Profil -->
        <div class="col-md-9">
            <!-- Informasi Profil -->
            <div class="card border-success shadow">
                <div class="card-header bg-success text-white">
                    <h5>Informasi Profil</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profil.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control border-success" id="name" name="name" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control border-success" id="email" name="email" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi Baru</label>
                            <input type="password" class="form-control border-success" id="password" name="password">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah kata sandi.</small>
                        </div>

                        <div class="pb-3">
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                            <a href="{{ url('layout/home') }}" class="btn btn-md btn-dark">Kembali</a>
                        </div>

                    </form>
                </div>
            </div>

            <!-- Informasi Tambahan -->
            <div class="card mt-4 border-success shadow">
                <div class="card-header bg-success text-white">
                    <h5>Informasi Tambahan</h5>
                </div>
                <div class="card-body">
                    <p><strong>Terdaftar Sejak : </strong> {{ Auth::user()->created_at->format('d M Y') }}</p>
                    <p><strong>Terakhir Diperbarui : </strong> {{ Auth::user()->updated_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
