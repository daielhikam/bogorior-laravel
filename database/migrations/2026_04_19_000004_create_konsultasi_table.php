<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('konsultasi')) {
            Schema::create('konsultasi', function (Blueprint $table) {
                $table->id('id_konsultasi');
                $table->foreignId('id_pelanggan')->nullable()->constrained('pelanggan', 'id_pelanggan')->onDelete('set null');
                $table->string('nama_konsultan', 100)->nullable();
                $table->string('no_whatsapp', 20);
                $table->string('email', 100)->nullable();
                $table->enum('jenis_layanan', ['custom', 'premium', 'renovasi', 'interior', 'konsultasi_desain']);
                $table->enum('budget', ['5-10', '10-20', '20-35', '35-50', '50+']);
                $table->string('ukuran_dapur', 50)->nullable();
                $table->text('alamat_lokasi')->nullable();
                $table->text('pesan_kebutuhan')->nullable();
                $table->enum('status_konsultasi', ['baru', 'diproses', 'dijadwalkan', 'selesai', 'dibatalkan'])->default('baru');
                $table->enum('dihubungi', ['ya', 'belum'])->default('belum');
                $table->datetime('jadwal_survey')->nullable();
                $table->text('catatan_admin')->nullable();
                $table->datetime('tanggal_konsultasi')->nullable();
                $table->timestamps();
                
                $table->index('status_konsultasi');
                $table->index('tanggal_konsultasi');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('konsultasi');
    }
};