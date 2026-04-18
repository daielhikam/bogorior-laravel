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
                $table->increments('id_gallery');
                $table->unsignedInteger('id_project');  // PERBAIKAN: pakai unsignedInteger
                $table->enum('jenis_foto', ['sebelum', 'proses', 'sesudah', 'detail', 'desain', 'material']);
                $table->string('nama_file', 255);
                $table->string('url_foto', 255);
                $table->string('deskripsi_foto', 200)->nullable();
                $table->tinyInteger('thumbnail')->default(0);
                $table->integer('urutan')->default(0);
                $table->timestamps();
                
                // Foreign key ke tabel project
                $table->foreign('id_project')->references('id_project')->on('project')->onDelete('cascade');
                
                $table->index('id_project');
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