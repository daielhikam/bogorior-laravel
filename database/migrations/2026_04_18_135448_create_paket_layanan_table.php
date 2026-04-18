<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('paket_layanan')) {
            Schema::create('paket_layanan', function (Blueprint $table) {
                $table->increments('id_paket');
                $table->string('nama_paket', 100);
                $table->string('slug_paket', 100)->unique();
                $table->enum('jenis_layanan', ['custom', 'premium', 'renovasi', 'interior']);
                $table->decimal('harga_mulai', 15, 2);
                $table->text('deskripsi_singkat')->nullable();
                $table->text('deskripsi_lengkap')->nullable();
                $table->text('fitur')->nullable();
                $table->text('spesifikasi')->nullable();
                $table->string('gambar_paket', 255)->nullable();
                $table->tinyInteger('popular')->default(0);
                $table->integer('urutan')->default(0);
                $table->tinyInteger('aktif')->default(1);
                $table->timestamps();
                
                $table->index('jenis_layanan');
                $table->index('popular');
                $table->index('aktif');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_layanan');
    }
};