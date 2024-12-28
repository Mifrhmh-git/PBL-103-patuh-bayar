<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    // Menentukan primary key tabel
    protected $primaryKey = 'id_bayar';

    // Menentukan nama tabel yang digunakan model ini
    protected $table = 'pembayarans';

    // Menentukan kolom-kolom yang dapat diisi secara massal (fillable)
    protected $fillable = [
        'id_warga',         // ID warga yang terkait dengan pembayaran
        'tanggal_pembayaran', // Tanggal pembayaran dilakukan
        'status_pembayaran',  // Status pembayaran (misalnya 'lunas', 'belum lunas')
        'image',             // Nama atau path gambar bukti pembayaran
        'created_at',        // Timestamp ketika data dibuat
        'updated_at',        // Timestamp ketika data terakhir diperbarui
    ];

    /**
     * Relasi: Pembayaran memiliki hubungan dengan Warga.
     * Ini berarti setiap pembayaran terkait dengan satu warga.
     */
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'id_warga');
    }
}
