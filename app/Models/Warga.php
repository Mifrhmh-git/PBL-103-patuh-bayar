<?php

// App\Models\Warga.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Mengimpor trait HasFactory untuk menggunakan factory pada model
use Illuminate\Database\Eloquent\Model; // Mengimpor class Model sebagai dasar untuk model Eloquent

class Warga extends Model
{
    use HasFactory; // Menggunakan trait HasFactory untuk mempermudah pembuatan instance model dalam seeding dan testing

    protected $primaryKey = 'id_warga'; // Menentukan kolom 'id_warga' sebagai primary key tabel Warga

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'nik', // Nomor Induk Kependudukan
        'nama', // Nama warga
        'rt', // RT tempat tinggal
        'alamat', // Alamat warga
        'email', // Email warga
        'no_telp', // Nomor telepon warga
    ];

    // Relasi antara model Warga dengan model Pembayaran
    public function Pembayarans()
    {
        // Menentukan hubungan one-to-one antara warga dan pembayaran
        return $this->hasOne(Pembayaran::class, 'id_warga'); // 'id_warga' adalah foreign key di tabel Pembayaran
    }

    // Boot method untuk event saat model dibuat
    protected static function boot()
    {
        parent::boot(); // Memanggil boot dari parent untuk tetap menjalankan fitur bawaan Eloquent

        // Event saat warga baru ditambahkan ke database
        static::created(function ($warga) {
            // Menambahkan data pembayaran pertama untuk warga yang baru dibuat
            $warga->pembayarans()->create([
                'tanggal_pembayaran' => now(), // Menggunakan tanggal dan waktu saat ini sebagai tanggal pembayaran
                'image' => null, // Tidak ada bukti pembayaran (gambar) di awal
                'status_pembayaran' => 'Belum Lunas', // Status pembayaran default adalah 'Belum Lunas'
            ]);
        });
    }
}
