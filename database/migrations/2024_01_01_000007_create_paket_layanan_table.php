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
        if (!Schema::hasTable('paket_layanan')) {
            Schema::create('paket_layanan', function (Blueprint $table) {
                // Primary Key
                $table->increments('id_paket');
                
                // Package Identity
                $table->string('nama_paket', 100);
                $table->string('slug_paket', 100)->unique();
                $table->enum('jenis_layanan', ['custom', 'premium', 'renovasi', 'interior']);
                
                // Pricing
                $table->decimal('harga_mulai', 15, 2);
                
                // Descriptions
                $table->text('deskripsi_singkat')->nullable();
                $table->text('deskripsi_lengkap')->nullable();
                $table->text('fitur')->nullable();
                $table->text('spesifikasi')->nullable();
                
                // Media
                $table->string('gambar_paket', 255)->nullable();
                
                // Display Settings
                $table->tinyInteger('popular')->default(0);
                $table->integer('urutan')->default(0);
                $table->tinyInteger('aktif')->default(1);
                
                // Timestamps
                $table->timestamps();
                
                // Indexes
                $table->index('jenis_layanan');
                $table->index('popular');
                $table->index('aktif');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('paket_layanan')) {
            Schema::dropIfExists('paket_layanan');
        }
    }
};