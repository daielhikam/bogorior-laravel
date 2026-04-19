<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('area_layanan')) {
            Schema::create('area_layanan', function (Blueprint $table) {
                $table->id('id_area');
                $table->string('nama_area', 100);
                $table->enum('jenis_area', ['kota', 'kabupaten', 'sekitar', 'luar_kota']);
                $table->text('daftar_lokasi')->nullable();
                $table->text('deskripsi')->nullable();
                $table->boolean('aktif')->default(true);
                $table->integer('urutan')->default(0);
                $table->timestamps();
                
                $table->index('jenis_area');
                $table->index('aktif');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('area_layanan');
    }
};