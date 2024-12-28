<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',      // Nama pengguna
        'email',     // Email pengguna
        'password',  // Password pengguna
    ];

    /**
     * Atribut yang harus disembunyikan saat diserialisasi (misalnya saat di-API response).
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',      // Menyembunyikan password agar tidak terlihat di JSON atau array
        'remember_token', // Token untuk "remember me" yang juga disembunyikan
    ];

    /**
     * Atribut yang harus di-cast (ubah tipe data) secara otomatis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',  // Mengubah format email_verified_at ke tipe datetime
        'password' => 'hashed',             // Mengenkripsi password secara otomatis
    ];
}
