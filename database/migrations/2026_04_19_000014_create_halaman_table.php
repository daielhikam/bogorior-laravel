<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('halaman')) {
            Schema::create('halaman', function (Blueprint $table) {
                $table->id('id_halaman');
                $table->string('judul_halaman', 200);
                $table->string('slug_halaman', 100)->unique();
                $table->longText('konten')->nullable();
                $table->enum('jenis_halaman', ['tentang', 'kontak', 'syarat_ketentuan', 'kebijakan_privasi', 'faq', 'lainnya'])->default('lainnya');
                $table->string('meta_title', 200)->nullable();
                $table->text('meta_description')->nullable();
                $table->enum('status_halaman', ['draft', 'publish'])->default('publish');
                $table->integer('urutan')->default(0);
                $table->timestamps();
                
                $table->index('jenis_halaman');
                $table->index('status_halaman');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('halaman');
    }
};