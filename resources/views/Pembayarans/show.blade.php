@section('konten')
@extends('layout.main')

@section('isi')

<div class="container mt-4">
    <!-- Kembali Button -->
    <div class="mb-3">
        <a href="{{ route('Pembayarans.index') }}" class="btn" style="background-color: #28a745; color: white; border: 2px solid #28a745; padding: 10px 15px; border-radius: 5px;">
            <b>Kembali</b>
        </a>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5>Detail Bukti Pembayaran Iuran</h5>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-body">
                    <!-- Image Section -->
                    <div class="text-center mb-3">
                        <img src="{{ asset('storage/Pembayarans/'.$post->image) }}"
                             class="img-thumbnail w-75 rounded"
                             alt="Pembayaran"
                             data-bs-toggle="modal"
                             data-bs-target="#imageModal">
                    </div>

                    <!-- Modal for Enlarged Image -->
                    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <img src="{{ asset('storage/Pembayarans/'.$post->image) }}"
                                         class="img-fluid rounded"
                                         alt="Pembayaran">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Informasi Warga -->
                    <h4 class="text-primary mb-3"><b>NIK : {{ $post->Warga->nik }}</b></h4>
                    <p class="text-muted mb-1">
                        <strong>Nama : </strong> {!! $post->Warga->nama !!}
                    </p>
                    <p class="text-muted mb-1">
                        <strong>RT : </strong> {!! $post->Warga->rt !!}
                    </p>
                    <p class="text-muted mb-1">
                        <strong>Alamat : </strong> {!! $post->Warga->alamat !!}
                    </p>
                    <p class="text-muted mb-1">
                        <strong>Email : </strong> {!! $post->Warga->email !!}
                    </p>
                    <p class="text-muted mb-1">
                        <strong>No.Telp : </strong> {!! $post->Warga->no_telp !!}
                    </p>

                    <!-- Button (optional) -->
                    @if (auth()->user()->role == 'bendahara')
                    <div class="text-end mt-4">
                        <a href="#rekapPembayaran" class="btn btn-dark btn-sm">Detail</a>
                        <a href="{{ route('Pembayarans.edit', $post->id_bayar) }}" class="btn btn-success btn-sm">Edit</a>
                    </div>
                    @elseif (auth()->user()->role == 'rw')
                    <div class="text-end mt-4">
                        <a href="#rekapPembayaran" class="btn btn-dark btn-sm">Detail</a>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Rekap Pembayaran Bulan per Bulan -->
    <div class="card mt-4" id="rekapPembayaran">
        <div class="card-header">
            <h5>Rekap Pembayaran per Bulan</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paymentStatuses as $status)
                        <tr>
                            <td>{{ $status['month'] }}</td>
                            <td>{{ $status['status'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
@endsection
