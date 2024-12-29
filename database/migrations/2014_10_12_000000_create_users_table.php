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
        // Membuat tabel users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role', 10);
            $table->string('image')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('pw', 30)->nullable();
            $table->string('password')->nullable();
            $table->rememberToken()->nullable();
            $table->timestamps();
        });

        // Menambahkan data default ke tabel users
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Bendahara RT',
                'role' => 'bendahara',
                'image' => null,
                'email' => 'bendahara-rt@gmail.com',
                'email_verified_at' => '2024-12-01 14:27:18',
                'pw' => 'bendahara-rt',
                'password' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Ketua RW',
                'role' => 'rw',
                'image' => null,
                'email' => 'rw@gmail.com',
                'email_verified_at' => '2024-12-12 06:48:06',
                'pw' => 'rw-1',
                'password' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
