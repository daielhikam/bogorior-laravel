<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('artikel')) {
            Schema::create('artikel', function (Blueprint $table) {
                $table->id('id_artikel');
                $table->string('judul_artikel', 200);
                $table->string('slug', 255)->unique();
                $table->longText('konten');
                $table->text('excerpt')->nullable();
                $table->string('gambar_utama', 255)->nullable();
                $table->enum('kategori', ['tips_panduan', 'desain_inspirasi', 'perawatan_maintenance', 'material_finishing', 'tren_terbaru', 'case_study']);
                $table->text('tags')->nullable();
                $table->string('penulis', 100)->default('Admin Bogorior');
                $table->enum('status_artikel', ['draft', 'publish', 'featured', 'arsip'])->default('draft');
                $table->boolean('featured')->default(false);
                $table->date('tanggal_publish')->nullable();
                $table->integer('views')->default(0);
                $table->string('meta_title', 200)->nullable();
                $table->string('meta_description', 300)->nullable();
                $table->timestamps();
                
                $table->index('kategori');
                $table->index('status_artikel');
                $table->index('featured');
                $table->index('tanggal_publish');
                $table->index('views');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};