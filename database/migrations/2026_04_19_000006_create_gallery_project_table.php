<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('gallery_project')) {
            Schema::create('gallery_project', function (Blueprint $table) {
                $table->id('id_gallery');
                // Perbaikan: tentukan kolom referensi yang benar (id_project)
                $table->foreignId('id_project')->constrained('project', 'id_project')->onDelete('cascade');
                $table->enum('jenis_foto', ['sebelum', 'proses', 'sesudah', 'detail', 'desain', 'material']);
                $table->string('nama_file', 255);
                $table->string('url_foto', 255);
                $table->string('deskripsi_foto', 200)->nullable();
                $table->boolean('thumbnail')->default(false);
                $table->integer('urutan')->default(0);
                $table->timestamps();
                
                $table->index('jenis_foto');
                $table->index('thumbnail');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_project');
    }
};