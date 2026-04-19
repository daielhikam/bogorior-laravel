<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('testimoni')) {
            Schema::create('testimoni', function (Blueprint $table) {
                $table->id('id_testimoni');
                // Perbaikan: tentukan kolom referensi yang benar (id_project)
                $table->foreignId('id_project')->nullable()->constrained('project', 'id_project')->onDelete('cascade');
                $table->string('nama_client', 100);
                $table->string('foto_client', 255)->nullable();
                $table->string('url_video', 500)->nullable();
                $table->enum('video_platform', ['youtube', 'vimeo', 'tiktok', 'instagram', 'facebook', 'local'])->nullable();
                $table->string('video_id', 200)->nullable();
                $table->string('video_thumbnail', 255)->nullable();
                $table->integer('rating');
                $table->text('testimoni');
                $table->string('jenis_project', 50)->nullable();
                $table->string('lokasi', 100)->nullable();
                $table->enum('status_testimoni', ['pending', 'approved', 'featured', 'arsip'])->default('pending');
                $table->enum('tipe_testimoni', ['teks', 'video'])->default('teks');
                $table->boolean('featured')->default(false);
                $table->date('tanggal_testimoni')->nullable();
                $table->timestamps();
                
                $table->index('status_testimoni');
                $table->index('featured');
                $table->index('rating');
                $table->index('tipe_testimoni');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('testimoni');
    }
};