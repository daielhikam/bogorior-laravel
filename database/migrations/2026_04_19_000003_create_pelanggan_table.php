<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pelanggan')) {
            Schema::create('pelanggan', function (Blueprint $table) {
                $table->id('id_pelanggan');
                $table->string('nama_lengkap', 100);
                $table->string('no_whatsapp', 20);
                $table->string('email', 100)->nullable();
                $table->text('alamat')->nullable();
                $table->enum('status_pelanggan', ['prospek', 'klien', 'selesai'])->default('prospek');
                $table->enum('sumber', ['website', 'instagram', 'facebook', 'tiktok', 'referensi', 'lainnya'])->default('website');
                $table->text('catatan')->nullable();
                $table->datetime('tanggal_daftar')->nullable();
                $table->timestamps();
                
                $table->index('status_pelanggan');
                $table->index('sumber');
                $table->index('tanggal_daftar');
                $table->index('no_whatsapp');
                $table->index('email');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};