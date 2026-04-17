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
        if (!Schema::hasTable('area_layanan')) {
            Schema::create('area_layanan', function (Blueprint $table) {
                // Primary Key
                $table->increments('id_area');
                
                // Area Identity
                $table->string('nama_area', 100);
                $table->enum('jenis_area', ['kota', 'kabupaten', 'sekitar', 'luar_kota']);
                $table->text('daftar_lokasi')->nullable();
                $table->text('deskripsi')->nullable();
                
                // Display Settings
                $table->tinyInteger('aktif')->default(1);
                $table->integer('urutan')->default(0);
                
                // Timestamps
                $table->timestamps();
                
                // Indexes
                $table->index('jenis_area');
                $table->index('aktif');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('area_layanan')) {
            Schema::dropIfExists('area_layanan');
        }
    }
};