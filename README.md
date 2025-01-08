# Patuh Bayar

## Deskripsi
**Patuh Bayar** adalah aplikasi berbasis web yang dirancang untuk memudahkan pengelolaan tagihan iuran di lingkungan perumahan. Aplikasi ini membantu memperlancar administrasi pembayaran, memastikan transparansi, serta meningkatkan efisiensi pengelolaan keuangan bulanan warga.

### Fitur Utama:
- **Pengelolaan Data Warga**: Tambah, edit, dan hapus data warga.
- **Pengelolaan Iuran Warga**: Kelola tagihan bulanan warga.
- **Riwayat Pembayaran**: Lihat riwayat pembayaran warga secara rinci.
- **Pengingat Pembayaran**: Kirimkan pengingat pembayaran melalui email.
- **Laporan Keuangan**: Hasilkan laporan dalam format PDF dan Excel.

---

## Daftar Isi
- [Patuh Bayar](#patuh-bayar)
  - [Deskripsi](#deskripsi)
    - [Fitur Utama:](#fitur-utama)
  - [Daftar Isi](#daftar-isi)
  - [Cara Instalasi](#cara-instalasi)
    - [Persyaratan Sistem](#persyaratan-sistem)
    - [Langkah Instalasi](#langkah-instalasi)
  - [Penggunaan](#penggunaan)
    - [Login](#login)
    - [Fungsi Utama](#fungsi-utama)
  - [Lisensi](#lisensi)
  - [Kontribusi](#kontribusi)
  - [Kontak](#kontak)

---

## Cara Instalasi

### Persyaratan Sistem
Pastikan sistem Anda memenuhi persyaratan berikut:
- **Server** : Apache (XAMPP)
- **PHP** : Versi 8.0 atau lebih baru
- **Database** : MySQL
- **Composer** : Dependency manager untuk PHP

### Langkah Instalasi

1. **Instalasi XAMPP**
   - Unduh XAMPP dari : [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html)
   - Ikuti langkah instalasi dan pastikan Apache serta MySQL berjalan di Control Panel XAMPP.

2. **Instalasi Composer**
   - Unduh Composer dari : [https://getcomposer.org/download/](https://getcomposer.org/download/)
   - Jalankan installer dan arahkan ke path `php.exe` dari XAMPP (contoh: `c:\xampp\php\php.exe`).

3. **Clone Repositori**
   Jalankan perintah berikut di terminal atau Git Bash:
   ```bash
   git clone https ://github.com/Mifrhmh-git/PBL-103-patuh-bayar.git
   cd PBL-103-patuh-bayar
   ```

4. **Instal Dependensi**
   ```bash
   composer install
   ```

5. **Konfigurasi .env**
   - Salin file `.env.example` menjadi `.env`
   - Sesuaikan pengaturan database di file `.env` sesuai konfigurasi XAMPP.

6. **Migrasi dan Seeder Database**
   ```bash
   php artisan migrate
   php artisan db:seed
   php artisan key:generate
   php artisan storage:link
   ```

7. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   ```
   Akses aplikasi melalui: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## Penggunaan

### Login
Gunakan akun berikut untuk masuk ke aplikasi:
- **Bendahara RT**  
  - Email : `bendahara-rt@gmail.com`  
  - Password : `bendahara-rt`

- **Ketua RW**  
  - Email : `rw@gmail.com`  
  - Password : `rw-1`

### Fungsi Utama
1. **Pengelolaan Data Warga** : Tambah, edit, dan hapus data warga.
2. **Pengelolaan Iuran Warga** : Kelola tagihan bulanan warga.
3. **Riwayat Pembayaran** : Lihat riwayat pembayaran warga secara rinci.
4. **Pengingat Pembayaran** : Kirimkan pengingat pembayaran melalui email.
5. **Laporan Keuangan** : Hasilkan laporan dalam format PDF dan Excel.

---

## Lisensi
Proyek ini menggunakan lisensi [MIT](LICENSE) - silakan lihat file LICENSE untuk informasi lebih lanjut.

---

## Kontribusi
Jika Anda ingin berkontribusi dalam pengembangan proyek ini, silakan ikuti langkah berikut:
1. Fork repositori ini.
2. Buat branch fitur baru (`git checkout -b fitur-baru`).
3. Commit perubahan Anda (`git commit -m 'Tambah fitur baru'`).
4. Push ke branch tersebut (`git push origin fitur-baru`).
5. Buat Pull Request.

---

## Kontak
Jika Anda memiliki pertanyaan atau memerlukan bantuan lebih lanjut, silakan hubungi kami:
- **Email** : support@patuhbayar.com
- **GitHub** : [https://github.com/Mifrhmh-git/PBL-103-patuh-bayar](https://github.com/Mifrhmh-git/PBL-103-patuh-bayar)

