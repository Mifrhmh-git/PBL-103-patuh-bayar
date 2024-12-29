<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Membuat tabel pembayarans
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->increments('id_bayar');
            $table->date('tanggal_pembayaran');
            $table->string('image')->nullable();
            $table->string('status_pembayaran', 20)->default('Belum Lunas');
            $table->unsignedInteger('id_warga');
            $table->foreign('id_warga')->references('id_warga')->on('wargas')->onDelete('cascade');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
