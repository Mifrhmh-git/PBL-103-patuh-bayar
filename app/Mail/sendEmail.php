<?php

namespace App\Mail;

use Illuminate\Bus\Queueable; // Mengimpor trait Queueable untuk memanfaatkan antrian email
use Illuminate\Contracts\Queue\ShouldQueue; // Mengimpor interface untuk mendukung antrian
use Illuminate\Mail\Mailable; // Mengimpor class Mailable untuk membuat email yang dapat dikirim
use Illuminate\Mail\Mailables\Content; // Mengimpor class Content untuk mendefinisikan isi email
use Illuminate\Mail\Mailables\Envelope; // Mengimpor class Envelope untuk mendefinisikan envelope email
use Illuminate\Queue\SerializesModels; // Mengimpor trait SerializesModels untuk serialisasi data model

class sendEmail extends Mailable
{
    use Queueable, SerializesModels; // Menggunakan trait Queueable untuk mengantri email dan SerializesModels untuk serialisasi model

    protected $data; // Mendeklarasikan properti untuk menyimpan data yang akan dikirimkan dalam email

    /**
     * Membuat instance pesan email baru.
     *
     * @param mixed $data Data yang akan dikirimkan ke view email
     */
    public function __construct($data)
    {
        $this->data = $data; // Menyimpan data yang dikirimkan ke properti $data
    }

    /**
     * Mendapatkan envelope pesan.
     * Envelope berisi informasi metadata seperti subjek email.
     *
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Email', // Menentukan subjek email
        );
    }

    /**
     * Mendapatkan definisi konten pesan.
     * Konten adalah tampilan (view) yang digunakan untuk isi email.
     *
     * @return Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.send_email', // Menentukan tampilan (view) yang digunakan untuk isi email
            with: [
                'data' => $this->data, // Mengirimkan data ke tampilan
            ],
        );
    }

    /**
     * Mendapatkan lampiran untuk pesan.
     * Jika ingin mengirimkan lampiran, bisa menambahkannya di sini.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return []; // Tidak ada lampiran yang dikirimkan
    }
}
