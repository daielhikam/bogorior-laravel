<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('pelanggan')) {
            Schema::create('pelanggan', function (Blueprint $table) {
                // Primary Key
                $table->increments('id_pelanggan');
                
                // Customer Info
                $table->string('nama_lengkap', 100);
                $table->string('no_whatsapp', 20);
                $table->string('email', 100)->nullable();
                $table->text('alamat')->nullable();
                
                // Status & Source
                $table->enum('status_pelanggan', ['prospek', 'klien', 'selesai'])->default('prospek');
                $table->enum('sumber', ['website', 'instagram', 'facebook', 'tiktok', 'referensi', 'lainnya'])->default('website');
                
                // Notes
                $table->text('catatan')->nullable();
                
                // Timestamps
                $table->datetime('tanggal_daftar')->nullable();
                $table->timestamps();
                
                // Indexes
                $table->index('status_pelanggan');
                $table->index('sumber');
                $table->index('tanggal_daftar');
                $table->index('no_whatsapp');
                $table->index('email');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('pelanggan')) {
            Schema::dropIfExists('pelanggan');
        }
    }
};